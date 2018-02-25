<?php
/**
 * SplitControllerTest.php
 * Copyright (c) 2017 thegrumpydictator@gmail.com
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

namespace Tests\Feature\Controllers\Transaction;

use FireflyIII\Helpers\Attachments\AttachmentHelperInterface;
use FireflyIII\Models\AccountType;
use FireflyIII\Models\Note;
use FireflyIII\Models\Transaction;
use FireflyIII\Models\TransactionJournal;
use FireflyIII\Repositories\Account\AccountRepositoryInterface;
use FireflyIII\Repositories\Budget\BudgetRepositoryInterface;
use FireflyIII\Repositories\Currency\CurrencyRepositoryInterface;
use FireflyIII\Repositories\Journal\JournalRepositoryInterface;
use FireflyIII\Repositories\Journal\JournalTaskerInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Tests\TestCase;

/**
 * Class SplitControllerTest
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SplitControllerTest extends TestCase
{
    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::edit
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::__construct
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::arrayFromJournal
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::updateWithPrevious
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::getTransactionDataFromJournal
     */
    public function testEdit()
    {
        $currencyRepository = $this->mock(CurrencyRepositoryInterface::class);
        $accountRepository  = $this->mock(AccountRepositoryInterface::class);
        $budgetRepository   = $this->mock(BudgetRepositoryInterface::class);
        $deposit            = TransactionJournal::where('transaction_type_id', 2)->where('user_id', $this->user()->id)->first();
        $journalRepos       = $this->mock(JournalRepositoryInterface::class);
        $destination        = $deposit->transactions()->where('amount', '>', 0)->first();
        $account            = $destination->account;
        $transactions       = factory(Transaction::class, 3)->make();
        $tasker             = $this->mock(JournalTaskerInterface::class);

        $journalRepos->shouldReceive('first')->once()->andReturn($deposit);
        $journalRepos->shouldReceive('getJournalSourceAccounts')->andReturn(new Collection([$account]));
        $journalRepos->shouldReceive('getJournalDestinationAccounts')->andReturn(new Collection([$account]));
        $journalRepos->shouldReceive('getTransactionType')->once()->andReturn('Deposit');
        $journalRepos->shouldReceive('getJournalDate')->andReturn('2018-01-01')->once();
        $journalRepos->shouldReceive('getMetaField')->andReturn('');
        $journalRepos->shouldReceive('getNoteText')->andReturn('Some note')->once();
        $journalRepos->shouldReceive('getJournalBudgetId')->andReturn(0);
        $journalRepos->shouldReceive('getCategoryName')->andReturn('');


        $currencyRepository->shouldReceive('get')->once()->andReturn(new Collection);
        $accountRepository->shouldReceive('getAccountsByType')->withArgs([[AccountType::DEFAULT, AccountType::ASSET]])
                          ->andReturn(new Collection([$account]))->once();
        $budgetRepository->shouldReceive('getActiveBudgets')->andReturn(new Collection);
        $tasker->shouldReceive('getTransactionsOverview')->andReturn($transactions->toArray());

        $this->be($this->user());
        $response = $this->get(route('transactions.split.edit', [$deposit->id]));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::edit
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::__construct
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::arrayFromJournal
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::updateWithPrevious
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::getTransactionDataFromJournal
     */
    public function testEditOldInput()
    {
        $currencyRepository = $this->mock(CurrencyRepositoryInterface::class);
        $accountRepository  = $this->mock(AccountRepositoryInterface::class);
        $budgetRepository   = $this->mock(BudgetRepositoryInterface::class);
        $journalRepos       = $this->mock(JournalRepositoryInterface::class);
        $deposit            = TransactionJournal::where('transaction_type_id', 2)->where('user_id', $this->user()->id)->first();
        $destination        = $deposit->transactions()->where('amount', '>', 0)->first();
        $account            = $destination->account;
        $transactions       = factory(Transaction::class, 3)->make();
        $tasker             = $this->mock(JournalTaskerInterface::class);

        $currencyRepository->shouldReceive('get')->once()->andReturn(new Collection);
        $accountRepository->shouldReceive('getAccountsByType')->withArgs([[AccountType::DEFAULT, AccountType::ASSET]])
                          ->andReturn(new Collection([$account]))->once();
        $budgetRepository->shouldReceive('getActiveBudgets')->andReturn(new Collection);
        $tasker->shouldReceive('getTransactionsOverview')->andReturn($transactions->toArray());

        $journalRepos->shouldReceive('first')->once()->andReturn($deposit);
        $journalRepos->shouldReceive('getJournalSourceAccounts')->andReturn(new Collection([$account]));
        $journalRepos->shouldReceive('getJournalDestinationAccounts')->andReturn(new Collection([$account]));
        $journalRepos->shouldReceive('getTransactionType')->once()->andReturn('Deposit');
        $journalRepos->shouldReceive('getJournalDate')->andReturn('2018-01-01')->once();
        $journalRepos->shouldReceive('getMetaField')->andReturn('');
        $journalRepos->shouldReceive('getNoteText')->andReturn('Some note')->once();
        $journalRepos->shouldReceive('getJournalBudgetId')->andReturn(0);
        $journalRepos->shouldReceive('getCategoryName')->andReturn('');


        $old = [
            'transactions' => [
                [
                    'transaction_currency_id'     => 1,
                    'transaction_currency_code'   => 'AB',
                    'transaction_currency_symbol' => 'X',
                    'foreign_amount'              => '0',
                    'foreign_currency_id'         => 2,
                    'foreign_currency_code'       => 'CD',
                    'foreign_currency_symbol'     => 'Y',
                ],
                [
                    'transaction_currency_id'     => 1,
                    'transaction_currency_code'   => 'AB',
                    'transaction_currency_symbol' => 'X',
                    'foreign_amount'              => '0',
                    'foreign_currency_id'         => 2,
                    'foreign_currency_code'       => 'CD',
                    'foreign_currency_symbol'     => 'Y',
                ],
                [
                    'transaction_currency_id'     => 1,
                    'transaction_currency_code'   => 'AB',
                    'transaction_currency_symbol' => 'X',
                    'foreign_amount'              => '0',
                    'foreign_currency_id'         => 2,
                    'foreign_currency_code'       => 'CD',
                    'foreign_currency_symbol'     => 'Y',
                ],
                [
                    'transaction_currency_id'     => 1,
                    'transaction_currency_code'   => 'AB',
                    'transaction_currency_symbol' => 'X',
                    'foreign_amount'              => '0',
                    'foreign_currency_id'         => 2,
                    'foreign_currency_code'       => 'CD',
                    'foreign_currency_symbol'     => 'Y',
                ],
                [
                    'transaction_currency_id'     => 1,
                    'transaction_currency_code'   => 'AB',
                    'transaction_currency_symbol' => 'X',
                    'foreign_amount'              => '0',
                    'foreign_currency_id'         => 2,
                    'foreign_currency_code'       => 'CD',
                    'foreign_currency_symbol'     => 'Y',
                ],

            ],
        ];
        $this->session(['_old_input' => $old]);

        $this->be($this->user());
        $response = $this->get(route('transactions.split.edit', [$deposit->id]));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }


    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::edit
     */
    public function testEditOpeningBalance()
    {
        $journalRepos = $this->mock(JournalRepositoryInterface::class);

        $opening = TransactionJournal::where('transaction_type_id', 4)->where('user_id', $this->user()->id)->first();
        $journalRepos->shouldReceive('first')->once()->andReturn($opening);
        $this->be($this->user());
        $response = $this->get(route('transactions.split.edit', [$opening->id]));
        $response->assertStatus(302);
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::edit
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::__construct
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::arrayFromJournal
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::updateWithPrevious
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::getTransactionDataFromJournal
     */
    public function testEditSingle()
    {
        $currencyRepository = $this->mock(CurrencyRepositoryInterface::class);
        $accountRepository  = $this->mock(AccountRepositoryInterface::class);
        $budgetRepository   = $this->mock(BudgetRepositoryInterface::class);
        $repository         = $this->mock(JournalRepositoryInterface::class);
        $transactions       = factory(Transaction::class, 1)->make();
        $tasker             = $this->mock(JournalTaskerInterface::class);
        $deposit            = TransactionJournal::where('transaction_type_id', 2)->where('user_id', $this->user()->id)->first();
        $destination        = $deposit->transactions()->where('amount', '>', 0)->first();
        $account            = $destination->account;

        $repository->shouldReceive('first')->once()->andReturn($deposit);
        $repository->shouldReceive('getJournalSourceAccounts')->andReturn(new Collection([$account]));
        $repository->shouldReceive('getJournalDestinationAccounts')->andReturn(new Collection([$account]));
        $repository->shouldReceive('getTransactionType')->once()->andReturn('Deposit');
        $repository->shouldReceive('getJournalDate')->once()->andReturn('2018-01-01');
        $repository->shouldReceive('getMetaField')->andReturn('');
        $repository->shouldReceive('getNoteText')->andReturn('Some note')->once();
        $repository->shouldReceive('getJournalBudgetId')->andReturn(0);
        $repository->shouldReceive('getCategoryName')->andReturn('');

        $currencyRepository->shouldReceive('get')->once()->andReturn(new Collection);
        $accountRepository->shouldReceive('getAccountsByType')->withArgs([[AccountType::DEFAULT, AccountType::ASSET]])
                          ->andReturn(new Collection([$account]))->once();
        $budgetRepository->shouldReceive('getActiveBudgets')->andReturn(new Collection);
        $tasker->shouldReceive('getTransactionsOverview')->andReturn($transactions->toArray());

        $this->be($this->user());
        $response = $this->get(route('transactions.split.edit', [$deposit->id]));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::update
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::arrayFromInput
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::getTransactionDataFromRequest
     */
    public function testUpdate()
    {
        $this->session(['transactions.edit-split.uri' => 'http://localhost']);
        $deposit = $this->user()->transactionJournals()->where('transaction_type_id', 2)->first();
        $data    = [
            'id'                             => $deposit->id,
            'what'                           => 'deposit',
            'journal_description'            => 'Updated salary',
            'journal_currency_id'            => 1,
            'journal_destination_account_id' => 1,
            'journal_amount'                 => 1591,
            'date'                           => '2014-01-24',
            'tags'                           => '',
            'transactions'                   => [
                [
                    'description'             => 'Split #1',
                    'source_account_name'     => 'Job',
                    'transaction_currency_id' => 1,
                    'amount'                  => 1591,
                    'category'                => '',
                ],
            ],
        ];

        // mock stuff
        $repository = $this->mock(JournalRepositoryInterface::class);
        $repository->shouldReceive('update')->andReturn($deposit);
        $repository->shouldReceive('first')->andReturn($deposit);
        $repository->shouldReceive('getTransactionType')->andReturn('Deposit');

        $attachmentRepos = $this->mock(AttachmentHelperInterface::class);
        $attachmentRepos->shouldReceive('saveAttachmentsForModel');
        $attachmentRepos->shouldReceive('getMessages')->andReturn(new MessageBag);

        $this->be($this->user());
        $response = $this->post(route('transactions.split.update', [$deposit->id]), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('index'));
        $response->assertSessionHas('success');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::update
     * @covers \FireflyIII\Http\Controllers\Transaction\SplitController::isOpeningBalance
     */
    public function testUpdateOpeningBalance()
    {
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $this->session(['transactions.edit-split.uri' => 'http://localhost']);
        $opening = TransactionJournal::where('transaction_type_id', 4)->where('user_id', $this->user()->id)->first();
        $data    = [
            'id'                             => $opening->id,
            'what'                           => 'opening balance',
            'journal_description'            => 'Updated salary',
            'journal_currency_id'            => 1,
            'journal_destination_account_id' => 1,
            'journal_amount'                 => 1591,
            'date'                           => '2014-01-24',
            'tags'                           => '',
            'transactions'                   => [
                [
                    'description'             => 'Split #1',
                    'source_account_name'     => 'Job',
                    'transaction_currency_id' => 1,
                    'amount'                  => 1591,
                    'category'                => '',
                ],
            ],
        ];

        $journalRepos->shouldReceive('first')->once()->andReturn($opening);
//        $journalRepos->shouldReceive('getJournalSourceAccounts')->andReturn(new Collection([$account]));
//        $journalRepos->shouldReceive('getJournalDestinationAccounts')->andReturn(new Collection([$account]));
        //$journalRepos->shouldReceive('getTransactionType')->once()->andReturn('Opening balance');
//        $journalRepos->shouldReceive('getJournalDate')->andReturn('2018-01-01')->once();
//        $journalRepos->shouldReceive('getMetaField')->andReturn('');
//        $journalRepos->shouldReceive('getNoteText')->andReturn('Some note')->once();
//        $journalRepos->shouldReceive('getJournalBudgetId')->andReturn(0);
//        $journalRepos->shouldReceive('getCategoryName')->andReturn('');


        $this->be($this->user());
        $response = $this->post(route('transactions.split.update', [$opening->id]), $data);
        $response->assertStatus(302);
        $response->assertSessionMissing('success');
    }
}
