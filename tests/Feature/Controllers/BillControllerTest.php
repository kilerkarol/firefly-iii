<?php
/**
 * BillControllerTest.php
 * Copyright (c) 2017 thegrumpydictator@gmail.com
 * This software may be modified and distributed under the terms of the Creative Commons Attribution-ShareAlike 4.0 International License.
 *
 * See the LICENSE file for details.
 */

declare(strict_types=1);

namespace Tests\Feature\Controllers;


use Carbon\Carbon;
use FireflyIII\Helpers\Collector\JournalCollectorInterface;
use FireflyIII\Models\Bill;
use FireflyIII\Models\TransactionJournal;
use FireflyIII\Repositories\Bill\BillRepositoryInterface;
use FireflyIII\Repositories\Journal\JournalRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Tests\TestCase;

/**
 * Class BillControllerTest
 *
 * @package Tests\Feature\Controllers
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BillControllerTest extends TestCase
{
    /**
     * @covers \FireflyIII\Http\Controllers\BillController::create
     */
    public function testCreate()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);

        $this->be($this->user());
        $response = $this->get(route('bills.create'));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::delete
     */
    public function testDelete()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);

        $this->be($this->user());
        $response = $this->get(route('bills.delete', [1]));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::destroy
     */
    public function testDestroy()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $repository   = $this->mock(BillRepositoryInterface::class);
        $repository->shouldReceive('destroy')->andReturn(true);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);

        $this->session(['bills.delete.uri' => 'http://localhost']);
        $this->be($this->user());
        $response = $this->post(route('bills.destroy', [1]));
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::edit
     */
    public function testEdit()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);

        $this->be($this->user());
        $response = $this->get(route('bills.edit', [1]));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::index
     * @covers \FireflyIII\Http\Controllers\BillController::__construct
     */
    public function testIndex()
    {
        // mock stuff
        $bill         = factory(Bill::class)->make();
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $repository   = $this->mock(BillRepositoryInterface::class);
        $repository->shouldReceive('getBills')->andReturn(new Collection([$bill]));
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);
        $repository->shouldReceive('getPaidDatesInRange')->once()->andReturn(new Collection([1, 2, 3]));
        $repository->shouldReceive('getPayDatesInRange')->once()->andReturn(new Collection([1, 2]));
        $repository->shouldReceive('nextExpectedMatch')->andReturn(new Carbon);

        $this->be($this->user());
        $response = $this->get(route('bills.index'));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::rescan
     */
    public function testRescan()
    {
        // mock stuff
        $journal      = factory(TransactionJournal::class)->make();
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $repository   = $this->mock(BillRepositoryInterface::class);
        $repository->shouldReceive('getPossiblyRelatedJournals')->once()->andReturn(new Collection([$journal]));
        $repository->shouldReceive('scan')->once();
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);

        $this->be($this->user());
        $response = $this->get(route('bills.rescan', [1]));
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::rescan
     */
    public function testRescanInactive()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);

        $this->be($this->user());
        $response = $this->get(route('bills.rescan', [3]));
        $response->assertStatus(302);
        $response->assertSessionHas('warning');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::show
     */
    public function testShow()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $collector    = $this->mock(JournalCollectorInterface::class);
        $repository   = $this->mock(BillRepositoryInterface::class);
        $repository->shouldReceive('getYearAverage')->andReturn('0');
        $repository->shouldReceive('getOverallAverage')->andReturn('0');
        $repository->shouldReceive('nextExpectedMatch')->andReturn(new Carbon);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);

        $collector->shouldReceive('setAllAssetAccounts')->andReturnSelf();
        $collector->shouldReceive('setBills')->andReturnSelf();
        $collector->shouldReceive('setLimit')->andReturnSelf();
        $collector->shouldReceive('setPage')->andReturnSelf();
        $collector->shouldReceive('withBudgetInformation')->andReturnSelf();
        $collector->shouldReceive('withCategoryInformation')->andReturnSelf();
        $collector->shouldReceive('getPaginatedJournals')->andReturn(new LengthAwarePaginator([], 0, 10));

        $this->be($this->user());
        $response = $this->get(route('bills.show', [1]));
        $response->assertStatus(200);
        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::store
     */
    public function testStore()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $repository   = $this->mock(BillRepositoryInterface::class);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);
        $repository->shouldReceive('store')->andReturn(new Bill);

        $data = [
            'name'                          => 'New Bill ' . rand(1000, 9999),
            'match'                         => 'some words',
            'amount_min'                    => '100',
            'amount_currency_id_amount_min' => 1,
            'amount_currency_id_amount_max' => 1,
            'skip'                          => 0,
            'amount_max'                    => '100',
            'date'                          => '2016-01-01',
            'repeat_freq'                   => 'monthly',
        ];
        $this->session(['bills.create.uri' => 'http://localhost']);
        $this->be($this->user());
        $response = $this->post(route('bills.store'), $data);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\BillController::update
     */
    public function testUpdate()
    {
        // mock stuff
        $journalRepos = $this->mock(JournalRepositoryInterface::class);
        $repository   = $this->mock(BillRepositoryInterface::class);
        $journalRepos->shouldReceive('first')->once()->andReturn(new TransactionJournal);
        $repository->shouldReceive('update')->andReturn(new Bill);

        $data = [
            'name'                          => 'Updated Bill ' . rand(1000, 9999),
            'match'                         => 'some more words',
            'amount_min'                    => '100',
            'amount_currency_id_amount_min' => 1,
            'amount_currency_id_amount_max' => 1,
            'skip'                          => 0,
            'amount_max'                    => '100',
            'date'                          => '2016-01-01',
            'repeat_freq'                   => 'monthly',
        ];
        $this->session(['bills.edit.uri' => 'http://localhost']);
        $this->be($this->user());
        $response = $this->post(route('bills.update', [1]), $data);
        $response->assertStatus(302);
        $response->assertSessionHas('success');

    }

}
