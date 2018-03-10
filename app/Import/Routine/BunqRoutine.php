<?php
/**
 * BunqRoutine.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Import\Routine;

use Exception;
use FireflyIII\Exceptions\FireflyException;
use FireflyIII\Models\ImportJob;
use FireflyIII\Repositories\ImportJob\ImportJobRepositoryInterface;
use FireflyIII\Services\Bunq\Id\DeviceServerId;
use FireflyIII\Services\Bunq\Object\DeviceServer;
use FireflyIII\Services\Bunq\Object\ServerPublicKey;
use FireflyIII\Services\Bunq\Request\DeviceServerRequest;
use FireflyIII\Services\Bunq\Request\DeviceSessionRequest;
use FireflyIII\Services\Bunq\Request\InstallationTokenRequest;
use FireflyIII\Services\Bunq\Request\ListDeviceServerRequest;
use FireflyIII\Services\Bunq\Token\InstallationToken;
use Illuminate\Support\Collection;
use Log;
use Preferences;
use Requests;

/**
 * Class BunqRoutine
 *
 * Steps before import:
 * 1) register device complete.
 *
 * Stage: 'initial'.
 *
 * 1) Get an installation token (if not present)
 * 2) Register device (if not found)
 *
 * Stage 'registered'
 *
 * 1) Get a session token. (new session)
 * 2) store user person / user company
 *
 * Stage 'logged-in'
 *
 * Get list of bank accounts
 *
 * Stage 'has-accounts'
 *
 * Do customer statement export (in CSV?)
 *
 *
 */
class BunqRoutine implements RoutineInterface
{
    /** @var Collection */
    public $errors;
    /** @var Collection */
    public $journals;
    /** @var int */
    public $lines = 0;
    /** @var ImportJob */
    private $job;

    /** @var ImportJobRepositoryInterface */
    private $repository;

    /**
     * ImportRoutine constructor.
     */
    public function __construct()
    {
        $this->journals = new Collection;
        $this->errors   = new Collection;
    }

    /**
     * @return Collection
     */
    public function getErrors(): Collection
    {
        return $this->errors;
    }

    /**
     * @return Collection
     */
    public function getJournals(): Collection
    {
        return $this->journals;
    }

    /**
     * @return int
     */
    public function getLines(): int
    {
        return $this->lines;
    }

    /**
     *
     * @return bool
     * @throws FireflyException
     */
    public function run(): bool
    {
        Log::info(sprintf('Start with import job %s using Bunq.', $this->job->key));
        set_time_limit(0);
        // check if job has token first!
        $stage = $this->getConfig()['stage'] ?? 'unknown';

        switch ($stage) {
            case 'initial':
                // register device and get tokens.
                $this->runStageInitial();
                break;
            case 'registered':
                // get all bank accounts of user.
                $this->runStageRegistered();
                break;

            default:
                throw new FireflyException(sprintf('No action for stage %s!', $stage));
                break;
            //            case 'has-token':

            //                // import routine does nothing at this point:
            //                break;
            //            case 'user-logged-in':
            //                $this->runStageLoggedIn();
            //                break;
            //            case 'have-account-mapping':
            //                $this->runStageHaveMapping();
            //                break;
            //            default:
            //                throw new FireflyException(sprintf('Cannot handle stage %s', $stage));
            //        }
            //
            //        return true;
        }

        return true;
    }

    /**
     * @param ImportJob $job
     */
    public function setJob(ImportJob $job)
    {
        $this->job        = $job;
        $this->repository = app(ImportJobRepositoryInterface::class);
        $this->repository->setUser($job->user);
    }

    /**
     *
     * @throws FireflyException
     */
    protected function runStageInitial()
    {
        Log::debug('In runStageInitial()');
        $this->setStatus('running');

        // register the device at Bunq:
        $serverId = $this->registerDevice();
        $this->addStep();
        Log::debug(sprintf('Found device server with id %d', $serverId->getId()));

        $config          = $this->getConfig();
        $config['stage'] = 'registered';
        $this->setConfig($config);

        return;
    }

    /**
     * Get a session token + userperson + usercompany. Store it in the job.
     *
     * @throws FireflyException
     */
    protected function runStageRegistered(): void
    {
        Log::debug('Now in runStageRegistered()');
        $apiKey            = Preferences::getForUser($this->job->user, 'bunq_api_key')->data;
        $serverPublicKey   = Preferences::getForUser($this->job->user, 'bunq_server_public_key')->data;
        $installationToken = $this->getInstallationToken();
        $request           = new DeviceSessionRequest;
        $request->setInstallationToken($installationToken);
        $request->setPrivateKey($this->getPrivateKey());
        $request->setServerPublicKey($serverPublicKey);
        $request->setSecret($apiKey);
        $request->call();

        // todo store objects in job!
        $deviceSession = $request->getDeviceSessionId();
        $userPerson    = $request->getUserPerson();
        $userCompany   = $request->getUserCompany();

        $config                      = $this->getConfig();
        $config['device_session_id'] = $deviceSession->toArray();
        $config['user_person']       = $userPerson->toArray();
        $config['user_company']      = $userCompany->toArray();
        $config['stage']             = 'logged-in';
        $this->setConfig($config);

        return;
    }

    /**
     * Shorthand method.
     */
    private function addStep()
    {
        $this->repository->addStepsDone($this->job, 1);
    }

    /**
     * Shorthand
     *
     * @param int $steps
     */
    private function addTotalSteps(int $steps)
    {
        $this->repository->addTotalSteps($this->job, $steps);
    }

    /**
     * This method creates a new public/private keypair for the user. This isn't really secure, since the key is generated on the fly with
     * no regards for HSM's, smart cards or other things. It would require some low level programming to get this right. But the private key
     * is stored encrypted in the database so it's something.
     */
    private function createKeyPair(): void
    {
        Log::debug('Now in createKeyPair()');
        $private = Preferences::getForUser($this->job->user, 'bunq_private_key', null);
        $public  = Preferences::getForUser($this->job->user, 'bunq_public_key', null);

        if (!(null === $private && null === $public)) {
            Log::info('Already have public and private key, return NULL.');

            return;
        }

        Log::debug('Generate new key pair for user.');
        $keyConfig = [
            'digest_alg'       => 'sha512',
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];
        // Create the private and public key
        $res = openssl_pkey_new($keyConfig);

        // Extract the private key from $res to $privKey
        $privKey = '';
        openssl_pkey_export($res, $privKey);

        // Extract the public key from $res to $pubKey
        $pubKey = openssl_pkey_get_details($res);

        Preferences::setForUser($this->job->user, 'bunq_private_key', $privKey);
        Preferences::setForUser($this->job->user, 'bunq_public_key', $pubKey['key']);
        Log::debug('Created and stored key pair');

        return;
    }

    /**
     * @return array
     */
    private function getConfig(): array
    {
        return $this->repository->getConfiguration($this->job);
    }

    /**
     * Try to detect the current device ID (in case this instance has been registered already.
     *
     * @return DeviceServerId
     *
     * @throws FireflyException
     */
    private function getExistingDevice(): ?DeviceServerId
    {
        Log::debug('Now in getExistingDevice()');
        $installationToken = $this->getInstallationToken();
        $serverPublicKey   = $this->getServerPublicKey();
        $request           = new ListDeviceServerRequest;
        $remoteIp          = $this->getRemoteIp();
        $request->setInstallationToken($installationToken);
        $request->setServerPublicKey($serverPublicKey);
        $request->setPrivateKey($this->getPrivateKey());
        $request->call();
        $devices = $request->getDevices();
        /** @var DeviceServer $device */
        foreach ($devices as $device) {
            if ($device->getIp() === $remoteIp) {
                Log::debug(sprintf('This instance is registered as device #%s', $device->getId()->getId()));

                return $device->getId();
            }
        }
        Log::info('This instance is not yet registered.');

        return null;
    }

    /**
     * Shorthand method.
     *
     * @return array
     */
    private function getExtendedStatus(): array
    {
        return $this->repository->getExtendedStatus($this->job);
    }

    /**
     * Get the installation token, either from the users preferences or from Bunq.
     *
     * @return InstallationToken
     * @throws FireflyException
     */
    private function getInstallationToken(): InstallationToken
    {
        Log::debug('Now in getInstallationToken().');
        $token = Preferences::getForUser($this->job->user, 'bunq_installation_token', null);
        if (null !== $token) {
            Log::debug('Have installation token, return it.');

            return $token->data;
        }
        Log::debug('Have no installation token, request one.');

        // verify bunq api code:
        $publicKey = $this->getPublicKey();
        $request   = new InstallationTokenRequest;
        $request->setPublicKey($publicKey);
        $request->call();
        Log::debug('Sent request for installation token.');

        $installationToken = $request->getInstallationToken();
        $installationId    = $request->getInstallationId();
        $serverPublicKey   = $request->getServerPublicKey();

        Preferences::setForUser($this->job->user, 'bunq_installation_token', $installationToken);
        Preferences::setForUser($this->job->user, 'bunq_installation_id', $installationId);
        Preferences::setForUser($this->job->user, 'bunq_server_public_key', $serverPublicKey);

        Log::debug('Stored token, ID and pub key.');

        return $installationToken;
    }

    /**
     * Get the private key from the users preferences.
     *
     * @return string
     */
    private function getPrivateKey(): string
    {
        Log::debug('In getPrivateKey()');
        $preference = Preferences::getForUser($this->job->user, 'bunq_private_key', null);
        if (null === $preference) {
            Log::debug('private key is null');
            // create key pair
            $this->createKeyPair();
        }
        $preference = Preferences::getForUser($this->job->user, 'bunq_private_key', null);
        Log::debug('Return private key for user');

        return $preference->data;
    }

    /**
     * Get a public key from the users preferences.
     *
     * @return string
     */
    private function getPublicKey(): string
    {
        Log::debug('Now in getPublicKey()');
        $preference = Preferences::getForUser($this->job->user, 'bunq_public_key', null);
        if (null === $preference) {
            Log::debug('public key is NULL.');
            // create key pair
            $this->createKeyPair();
        }
        $preference = Preferences::getForUser($this->job->user, 'bunq_public_key', null);
        Log::debug('Return public key for user');

        return $preference->data;
    }

    /**
     * Request users server remote IP. Let's assume this value will not change any time soon.
     *
     * @return string
     *
     * @throws FireflyException
     */
    private function getRemoteIp(): string
    {
        $preference = Preferences::getForUser($this->job->user, 'external_ip', null);
        if (null === $preference) {
            try {
                $response = Requests::get('https://api.ipify.org');
            } catch (Exception $e) {
                throw new FireflyException(sprintf('Could not retrieve external IP: %s', $e->getMessage()));
            }
            if (200 !== $response->status_code) {
                throw new FireflyException(sprintf('Could not retrieve external IP: %d %s', $response->status_code, $response->body));
            }
            $serverIp = $response->body;
            Preferences::setForUser($this->job->user, 'external_ip', $serverIp);

            return $serverIp;
        }

        return $preference->data;
    }

    /**
     * Get the public key of the server, necessary to verify server signature.
     *
     * @return ServerPublicKey
     * @throws FireflyException
     */
    private function getServerPublicKey(): ServerPublicKey
    {
        $pref = Preferences::getForUser($this->job->user, 'bunq_server_public_key', null)->data;
        if (is_null($pref)) {
            throw new FireflyException('Cannot determine bunq server public key, but should have it at this point.');
        }

        return $pref;
    }

    /**
     * Shorthand method.
     *
     * @return string
     */
    private function getStatus(): string
    {
        return $this->repository->getStatus($this->job);
    }

    /**
     * To install Firefly III as a new device:
     * - Send an installation token request.
     * - Use this token to send a device server request
     * - Store the installation token
     * - Use the installation token each time we need a session.
     *
     * @throws FireflyException
     */
    private function registerDevice(): DeviceServerId
    {
        Log::debug('Now in registerDevice()');
        $deviceServerId = Preferences::getForUser($this->job->user, 'bunq_device_server_id', null);
        $serverIp       = $this->getRemoteIp();
        if (null !== $deviceServerId) {
            Log::debug('Already have device server ID.');

            return $deviceServerId->data;
        }

        Log::debug('Device server ID is null, we have to find an existing one or register a new one.');
        $installationToken = $this->getInstallationToken();
        $serverPublicKey   = $this->getServerPublicKey();
        $apiKey            = Preferences::getForUser($this->job->user, 'bunq_api_key', '');
        $this->addStep();

        // try get the current from a list:
        $deviceServerId = $this->getExistingDevice();
        $this->addStep();
        if (null !== $deviceServerId) {
            Log::debug('Found device server ID in existing devices list.');

            return $deviceServerId;
        }

        Log::debug('Going to create new DeviceServerRequest() because nothing found in existing list.');
        $request = new DeviceServerRequest;
        $request->setPrivateKey($this->getPrivateKey());
        $request->setDescription('Firefly III v' . config('firefly.version') . ' for ' . $this->job->user->email);
        $request->setSecret($apiKey->data);
        $request->setPermittedIps([$serverIp]);
        $request->setInstallationToken($installationToken);
        $request->setServerPublicKey($serverPublicKey);
        $deviceServerId = null;
        // try to register device:
        try {
            $request->call();
            $deviceServerId = $request->getDeviceServerId();
        } catch (FireflyException $e) {
            Log::error($e->getMessage());
            // we really have to quit at this point :(
            throw new FireflyException($e->getMessage());
        }
        if (is_null($deviceServerId)) {
            throw new FireflyException('Was not able to register server with bunq. Please see the log files.');
        }

        Preferences::setForUser($this->job->user, 'bunq_device_server_id', $deviceServerId);
        Log::debug(sprintf('Server ID: %s', serialize($deviceServerId)));

        return $deviceServerId;
    }

    /**
     * Shorthand.
     *
     * @param array $config
     */
    private function setConfig(array $config): void
    {
        $this->repository->setConfiguration($this->job, $config);

        return;
    }

    /**
     * Shorthand method.
     *
     * @param array $extended
     */
    private function setExtendedStatus(array $extended): void
    {
        $this->repository->setExtendedStatus($this->job, $extended);

        return;
    }

    /**
     * Shorthand.
     *
     * @param string $status
     */
    private function setStatus(string $status): void
    {
        $this->repository->setStatus($this->job, $status);
    }
}