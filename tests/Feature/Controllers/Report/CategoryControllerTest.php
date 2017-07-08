<?php
/**
 * CategoryControllerTest.php
 * Copyright (c) 2017 thegrumpydictator@gmail.com
 * This software may be modified and distributed under the terms of the Creative Commons Attribution-ShareAlike 4.0 International License.
 *
 * See the LICENSE file for details.
 */

declare(strict_types=1);

namespace Tests\Feature\Controllers\Report;


use FireflyIII\Models\Category;
use FireflyIII\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * @covers \FireflyIII\Http\Controllers\Report\CategoryController::expenses
     * @covers \FireflyIII\Http\Controllers\Report\CategoryController::filterReport
     */
    public function testExpenses()
    {
        $first      = [1 => ['entries' => ['1', '1']]];
        $second     = ['entries' => ['1', '1']];
        $repository = $this->mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('getCategories')->andReturn(new Collection);
        $repository->shouldReceive('periodExpenses')->andReturn($first);
        $repository->shouldReceive('periodExpensesNoCategory')->andReturn($second);

        $this->be($this->user());
        $response = $this->get(route('report-data.category.expenses', ['1', '20120101', '20120131']));
        $response->assertStatus(200);
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Report\CategoryController::income
     * @covers \FireflyIII\Http\Controllers\Report\CategoryController::filterReport
     */
    public function testIncome()
    {
        $first      = [1 => ['entries' => ['1', '1']]];
        $second     = ['entries' => ['1', '1']];
        $repository = $this->mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('getCategories')->andReturn(new Collection);
        $repository->shouldReceive('periodIncome')->andReturn($first);
        $repository->shouldReceive('periodIncomeNoCategory')->andReturn($second);

        $this->be($this->user());
        $response = $this->get(route('report-data.category.income', ['1', '20120101', '20120131']));
        $response->assertStatus(200);
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Report\CategoryController::operations
     */
    public function testOperations()
    {
        $repository = $this->mock(CategoryRepositoryInterface::class);
        $category   = factory(Category::class)->make();
        $repository->shouldReceive('getCategories')->andReturn(new Collection([$category]));
        $repository->shouldReceive('spentInPeriod')->andReturn('-1');

        $this->be($this->user());
        $response = $this->get(route('report-data.category.operations', ['1', '20120101', '20120131']));
        $response->assertStatus(200);
    }

}
