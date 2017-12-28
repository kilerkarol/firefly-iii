<?php
/**
 * UpdateControllerTest.php
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

namespace Tests\Feature\Controllers\Admin;

use FireflyConfig;
use FireflyIII\Models\Configuration;
use FireflyIII\Services\Github\Request\UpdateRequest;
use Tests\TestCase;

/**
 * Class UpdateControllerTest
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class UpdateControllerTest extends TestCase
{
    /**
     * @covers \FireflyIII\Http\Controllers\Admin\UpdateController::index
     * @covers \FireflyIII\Http\Controllers\Admin\UpdateController::__construct
     */
    public function testIndex()
    {
        $this->be($this->user());

        $config       = new Configuration;
        $config->data = -1;

        $falseConfig       = new Configuration;
        $falseConfig->data = false;

        FireflyConfig::shouldReceive('get')->withArgs(['permission_update_check', -1])->once()->andReturn($config);
        FireflyConfig::shouldReceive('get')->withArgs(['is_demo_site', false])->once()->andReturn($falseConfig);

        $response = $this->get(route('admin.update-check'));
        $response->assertStatus(200);

        // has bread crumb
        $response->assertSee('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Admin\UpdateController::post
     */
    public function testPost()
    {
        $falseConfig       = new Configuration;
        $falseConfig->data = false;

        FireflyConfig::shouldReceive('get')->withArgs(['is_demo_site', false])->once()->andReturn($falseConfig);
        FireflyConfig::shouldReceive('set')->withArgs(['permission_update_check', 1])->once()->andReturn(new Configuration);
        $this->be($this->user());
        $response = $this->post(route('admin.update-check.post'), ['check_for_updates' => 1]);
        $response->assertSessionHas('success');
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.update-check'));
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Admin\UpdateController::updateCheck
     */
    public function testUpdateCheck()
    {

        $releases = [

        ];
        $updater = $this->mock(UpdateRequest::class);
        $updater->shouldReceive('call')->andReturnNull();
        $updater->shouldReceive('getReleases')->andReturn(true);


        $this->be($this->user());
        $response = $this->post(route('admin.update-check.manual'));
        $response->assertStatus(200);
    }



    //    /**
    //     * @covers \FireflyIII\Http\Controllers\Admin\ConfigurationController::postIndex
    //     */
    //    public function testPostIndex()
    //    {
    //        $falseConfig       = new Configuration;
    //        $falseConfig->data = false;
    //
    //        FireflyConfig::shouldReceive('get')->withArgs(['is_demo_site', false])->once()->andReturn($falseConfig);
    //        FireflyConfig::shouldReceive('set')->withArgs(['single_user_mode', false])->once();
    //        FireflyConfig::shouldReceive('set')->withArgs(['is_demo_site', false])->once();
    //
    //        $this->be($this->user());
    //        $response = $this->post(route('admin.configuration.index.post'));
    //        $response->assertSessionHas('success');
    //        $response->assertStatus(302);
    //    }
}
