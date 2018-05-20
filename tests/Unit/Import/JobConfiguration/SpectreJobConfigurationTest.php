<?php
/**
 * SpectreJobConfigurationTest.php
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

namespace Tests\Unit\Import\JobConfiguration;

use FireflyIII\Exceptions\FireflyException;
use FireflyIII\Import\JobConfiguration\SpectreJobConfiguration;
use FireflyIII\Models\ImportJob;
use FireflyIII\Support\Import\JobConfiguration\Spectre\AuthenticateConfig;
use FireflyIII\Support\Import\JobConfiguration\Spectre\AuthenticatedConfigHandler;
use FireflyIII\Support\Import\JobConfiguration\Spectre\ChooseAccount;
use FireflyIII\Support\Import\JobConfiguration\Spectre\ChooseLoginHandler;
use FireflyIII\Support\Import\JobConfiguration\Spectre\NewConfig;
use Illuminate\Support\MessageBag;
use Tests\TestCase;

/**
 * Class SpectreJobConfigurationTest
 */
class SpectreJobConfigurationTest extends TestCase
{
    /**
     * @covers \FireflyIII\Import\JobConfiguration\SpectreJobConfiguration
     */
    public function testConfigurationComplete(): void
    {
        $job                = new ImportJob;
        $job->user_id       = $this->user()->id;
        $job->key           = 'spectre_jc_A' . random_int(1, 1000);
        $job->status        = 'new';
        $job->stage         = 'new';
        $job->provider      = 'spectre';
        $job->file_type     = '';
        $job->configuration = [];
        $job->save();

        // expect "NewConfig" to be created because job is new.
        $handler = $this->mock(NewConfig::class);
        $handler->shouldReceive('setImportJob')->once();
        $handler->shouldReceive('configurationComplete')->once()->andReturn(true);

        $config = new SpectreJobConfiguration;
        try {
            $config->setImportJob($job);
        } catch (FireflyException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
        $this->assertTrue($config->configurationComplete());
    }

    /**
     * @covers \FireflyIII\Import\JobConfiguration\SpectreJobConfiguration
     */
    public function testConfigureJob(): void
    {
        $job                = new ImportJob;
        $job->user_id       = $this->user()->id;
        $job->key           = 'spectre_jc_B' . random_int(1, 1000);
        $job->status        = 'new';
        $job->stage         = 'authenticate';
        $job->provider      = 'spectre';
        $job->file_type     = '';
        $job->configuration = [];
        $job->save();
        $configData = ['ssome' => 'values'];
        $return     = new MessageBag();
        $return->add('some', 'return message');

        // expect "NewConfig" to be created because job is new.
        $handler = $this->mock(AuthenticateConfig::class);
        $handler->shouldReceive('setImportJob')->once();
        $handler->shouldReceive('configureJob')->once()->withArgs([$configData])->andReturn($return);

        $config = new SpectreJobConfiguration;
        try {
            $config->setImportJob($job);
        } catch (FireflyException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
        $this->assertEquals($return, $config->configureJob($configData));
    }

    /**
     * @covers \FireflyIII\Import\JobConfiguration\SpectreJobConfiguration
     */
    public function testGetNextData(): void
    {
        $job                = new ImportJob;
        $job->user_id       = $this->user()->id;
        $job->key           = 'spectre_jc_C' . random_int(1, 1000);
        $job->status        = 'new';
        $job->stage         = 'choose-login';
        $job->provider      = 'spectre';
        $job->file_type     = '';
        $job->configuration = [];
        $job->save();
        $data = ['ssome' => 'values'];

        $handler = $this->mock(ChooseLoginHandler::class);
        $handler->shouldReceive('setImportJob')->once();
        $handler->shouldReceive('getNextData')->once()->andReturn($data);

        $config = new SpectreJobConfiguration;
        try {
            $config->setImportJob($job);
        } catch (FireflyException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
        $this->assertEquals($data, $config->getNextData());
    }

    /**
     * @covers \FireflyIII\Import\JobConfiguration\SpectreJobConfiguration
     */
    public function testGetNextView(): void
    {
        $job                = new ImportJob;
        $job->user_id       = $this->user()->id;
        $job->key           = 'spectre_jc_D' . random_int(1, 1000);
        $job->status        = 'new';
        $job->stage         = 'authenticated';
        $job->provider      = 'spectre';
        $job->file_type     = '';
        $job->configuration = [];
        $job->save();

        $handler = $this->mock(AuthenticatedConfigHandler::class);
        $handler->shouldReceive('setImportJob')->once();
        $handler->shouldReceive('getNextView')->once()->andReturn('import.fake.view');

        $config = new SpectreJobConfiguration;
        try {
            $config->setImportJob($job);
        } catch (FireflyException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
        $this->assertEquals('import.fake.view', $config->getNextView());
    }

    /**
     * @covers \FireflyIII\Import\JobConfiguration\SpectreJobConfiguration
     */
    public function testGetNextViewAccount(): void
    {
        $job                = new ImportJob;
        $job->user_id       = $this->user()->id;
        $job->key           = 'spectre_jc_E' . random_int(1, 1000);
        $job->status        = 'new';
        $job->stage         = 'choose-account';
        $job->provider      = 'spectre';
        $job->file_type     = '';
        $job->configuration = [];
        $job->save();

        $handler = $this->mock(ChooseAccount::class);
        $handler->shouldReceive('setImportJob')->once();
        $handler->shouldReceive('getNextView')->once()->andReturn('import.fake.view2');

        $config = new SpectreJobConfiguration;
        try {
            $config->setImportJob($job);
        } catch (FireflyException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
        $this->assertEquals('import.fake.view2', $config->getNextView());
    }


}