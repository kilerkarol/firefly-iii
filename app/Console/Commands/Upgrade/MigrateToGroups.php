<?php
/**
 * MigrateToGroups.php
 * Copyright (c) 2019 thegrumpydictator@gmail.com
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

namespace FireflyIII\Console\Commands\Upgrade;

use DB;
use Exception;
use FireflyIII\Factory\TransactionJournalFactory;
use FireflyIII\Models\Transaction;
use FireflyIII\Models\TransactionJournal;
use FireflyIII\Repositories\Journal\JournalRepositoryInterface;
use FireflyIII\Services\Internal\Destroy\JournalDestroyService;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Log;

/**
 * This command will take split transactions and migrate them to "transaction groups".
 *
 * It will only run once, but can be forced to run again.
 *
 * Class MigrateToGroups
 */
class MigrateToGroups extends Command
{
    public const CONFIG_NAME = '4780_migrated_to_groups';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrates a pre-4.7.8 transaction structure to the 4.7.8+ transaction structure.';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'firefly-iii:migrate-to-groups {--F|force : Force the migration, even if it fired before.}';

    /** @var TransactionJournalFactory */
    private $journalFactory;

    /** @var JournalRepositoryInterface */
    private $journalRepository;

    /** @var JournalDestroyService */
    private $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->journalFactory    = app(TransactionJournalFactory::class);
        $this->journalRepository = app(JournalRepositoryInterface::class);
        $this->service           = app(JournalDestroyService::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        $start = microtime(true);
        if ($this->isMigrated() && true !== $this->option('force')) {
            $this->info('Database already seems to be migrated.');

            return 0;
        }
        if (true === $this->option('force')) {
            $this->warn('Forcing the migration.');
        }

        Log::debug('---- start group migration ----');
        $this->makeGroupsFromSplitJournals();
        $end = round(microtime(true) - $start, 2);
        $this->info(sprintf('Migrate split journals to groups in %s seconds.', $end));

        $start = microtime(true);
        $this->makeGroupsFromAll();
        Log::debug('---- end group migration ----');
        $end = round(microtime(true) - $start, 2);
        $this->info(sprintf('Migrate all journals to groups in %s seconds.', $end));
        $this->markAsMigrated();

        return 0;
    }

    /**
     * @param TransactionJournal $journal
     * @param Transaction        $transaction
     *
     * @return Transaction|null
     */
    private function findOpposingTransaction(TransactionJournal $journal, Transaction $transaction): ?Transaction
    {
        $set = $journal->transactions->filter(
            function (Transaction $subject) use ($transaction) {
                return $transaction->amount * -1 === (float)$subject->amount && $transaction->identifier === $subject->identifier;
            }
        );

        return $set->first();
    }

    /**
     * @param TransactionJournal $journal
     *
     * @return Collection
     */
    private function getDestinationTransactions(TransactionJournal $journal): Collection
    {
        return $journal->transactions->filter(
            function (Transaction $transaction) {
                return $transaction->amount > 0;
            }
        );
    }

    /**
     * @param array $array
     */
    private function giveGroup(array $array): void
    {
        $groupId = DB::table('transaction_groups')->insertGetId(['title' => null, 'user_id' => $array['user_id']]);
        DB::table('transaction_journals')->where('id', $array['id'])->update(['transaction_group_id' => $groupId]);
    }

    /**
     * @return bool
     */
    private function isMigrated(): bool
    {
        $configVar = app('fireflyconfig')->get(self::CONFIG_NAME, false);
        if (null !== $configVar) {
            return (bool)$configVar->data;
        }

        return false; // @codeCoverageIgnore
    }

    /**
     * Gives all journals without a group a group.
     */
    private function makeGroupsFromAll(): void
    {
        $orphanedJournals = $this->journalRepository->getJournalsWithoutGroup();
        $count            = count($orphanedJournals);
        if ($count > 0) {
            Log::debug(sprintf('Going to convert %d transaction journals. Please hold..', $count));
            $this->line(sprintf('Going to convert %d transaction journals. Please hold..', $count));
            /** @var array $journal */
            foreach ($orphanedJournals as $array) {
                $this->giveGroup($array);
            }
        }
        if (0 === $count) {
            $this->info('No need to convert transaction journals.');
        }
    }

    /**
     * @throws Exception
     */
    private function makeGroupsFromSplitJournals(): void
    {
        $splitJournals = $this->journalRepository->getSplitJournals();
        if ($splitJournals->count() > 0) {
            $this->info(sprintf('Going to convert %d split transaction(s). Please hold..', $splitJournals->count()));
            /** @var TransactionJournal $journal */
            foreach ($splitJournals as $journal) {
                $this->makeMultiGroup($journal);
            }
        }
        if (0 === $splitJournals->count()) {
            $this->info('Found no split transaction journals. Nothing to do.');
        }
    }

    /**
     * @param TransactionJournal $journal
     *
     * @throws Exception
     */
    private function makeMultiGroup(TransactionJournal $journal): void
    {
        // double check transaction count.
        if ($journal->transactions->count() <= 2) {
            Log::debug(sprintf('Will not try to convert journal #%d because it has 2 or less transactions.', $journal->id));

            return;
        }
        Log::debug(sprintf('Will now try to convert journal #%d', $journal->id));

        $this->journalRepository->setUser($journal->user);
        $this->journalFactory->setUser($journal->user);

        $data             = [
            // mandatory fields.
            'type'         => strtolower($journal->transactionType->type),
            'date'         => $journal->date,
            'user'         => $journal->user_id,
            'group_title'  => $journal->description,
            'transactions' => [],
        ];
        $destTransactions = $this->getDestinationTransactions($journal);
        $budgetId         = $this->journalRepository->getJournalBudgetId($journal);
        $categoryId       = $this->journalRepository->getJournalCategoryId($journal);
        $notes            = $this->journalRepository->getNoteText($journal);
        $tags             = $this->journalRepository->getTags($journal);
        $internalRef      = $this->journalRepository->getMetaField($journal, 'internal-reference');
        $sepaCC           = $this->journalRepository->getMetaField($journal, 'sepa-cc');
        $sepaCtOp         = $this->journalRepository->getMetaField($journal, 'sepa-ct-op');
        $sepaCtId         = $this->journalRepository->getMetaField($journal, 'sepa-ct-id');
        $sepaDb           = $this->journalRepository->getMetaField($journal, 'sepa-db');
        $sepaCountry      = $this->journalRepository->getMetaField($journal, 'sepa-country');
        $sepaEp           = $this->journalRepository->getMetaField($journal, 'sepa-ep');
        $sepaCi           = $this->journalRepository->getMetaField($journal, 'sepa-ci');
        $sepaBatchId      = $this->journalRepository->getMetaField($journal, 'sepa-batch-id');
        $externalId       = $this->journalRepository->getMetaField($journal, 'external-id');
        $originalSource   = $this->journalRepository->getMetaField($journal, 'original-source');
        $recurrenceId     = $this->journalRepository->getMetaField($journal, 'recurrence_id');
        $bunq             = $this->journalRepository->getMetaField($journal, 'bunq_payment_id');
        $hash             = $this->journalRepository->getMetaField($journal, 'importHash');
        $hashTwo          = $this->journalRepository->getMetaField($journal, 'importHashV2');
        $interestDate     = $this->journalRepository->getMetaDate($journal, 'interest_date');
        $bookDate         = $this->journalRepository->getMetaDate($journal, 'book_date');
        $processDate      = $this->journalRepository->getMetaDate($journal, 'process_date');
        $dueDate          = $this->journalRepository->getMetaDate($journal, 'due_date');
        $paymentDate      = $this->journalRepository->getMetaDate($journal, 'payment_date');
        $invoiceDate      = $this->journalRepository->getMetaDate($journal, 'invoice_date');


        Log::debug(sprintf('Will use %d positive transactions to create a new group.', $destTransactions->count()));

        /** @var Transaction $transaction */
        foreach ($destTransactions as $transaction) {
            Log::debug(sprintf('Now going to add transaction #%d to the array.', $transaction->id));
            $opposingTr = $this->findOpposingTransaction($journal, $transaction);

            if (null === $opposingTr) {
                $this->error(
                    sprintf(
                        'Journal #%d has no opposing transaction for transaction #%d. Cannot upgrade this entry.',
                        $journal->id, $transaction->id
                    )
                );
                continue;
            }

            $tArray = [
                'currency_id'         => $transaction->transaction_currency_id,
                'foreign_currency_id' => $transaction->foreign_currency_id,
                'amount'              => $transaction->amount,
                'foreign_amount'      => $transaction->foreign_amount,
                'description'         => $transaction->description ?? $journal->description,
                'source_id'           => $opposingTr->account_id,
                'destination_id'      => $transaction->account_id,
                'budget_id'           => $budgetId,
                'category_id'         => $categoryId,
                'bill_id'             => $journal->bill_id,
                'notes'               => $notes,
                'tags'                => $tags,
                'internal_reference'  => $internalRef,
                'sepa-cc'             => $sepaCC,
                'sepa-ct-op'          => $sepaCtOp,
                'sepa-ct-id'          => $sepaCtId,
                'sepa-db'             => $sepaDb,
                'sepa-country'        => $sepaCountry,
                'sepa-ep'             => $sepaEp,
                'sepa-ci'             => $sepaCi,
                'sepa-batch-id'       => $sepaBatchId,
                'external_id'         => $externalId,
                'original-source'     => $originalSource,
                'recurrence_id'       => $recurrenceId,
                'bunq_payment_id'     => $bunq,
                'importHash'          => $hash,
                'importHashV2'        => $hashTwo,
                'interest_date'       => $interestDate,
                'book_date'           => $bookDate,
                'process_date'        => $processDate,
                'due_date'            => $dueDate,
                'payment_date'        => $paymentDate,
                'invoice_date'        => $invoiceDate,
            ];

            $data['transactions'][] = $tArray;
        }
        Log::debug(sprintf('Now calling transaction journal factory (%d transactions in array)', count($data['transactions'])));
        $result = $this->journalFactory->create($data);
        Log::debug('Done calling transaction journal factory');

        // delete the old transaction journal.
        $this->service->destroy($journal);

        // report on result:
        Log::debug(sprintf('Migrated journal #%d into these journals: #%s', $journal->id, implode(', #', $result->pluck('id')->toArray())));
        $this->line(sprintf('Migrated journal #%d into these journals: #%s', $journal->id, implode(', #', $result->pluck('id')->toArray())));
    }

    /**
     *
     */
    private function markAsMigrated(): void
    {
        app('fireflyconfig')->set(self::CONFIG_NAME, true);
    }

}
