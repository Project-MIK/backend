<?php

namespace Tests\Feature;

use App\Http\Controllers\ScheduleController;
use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    private ScheduleController $controller;

    public function test_success_findAll_data_schedules()
    {
        $this->controller = new ScheduleController();
        $data = $this->controller->index();

        $this->assertNotNull($data);
    }

    public function test_failed_findAll_data_schedules() {
        $this->controller = new ScheduleController();
        $data = $this->controller->index();

        $this->assertNull($data);
    }

    public function test_success_findById_data_schedule() {
        $this->controller = new ScheduleController();
        $data = $this->controller->show(1);

        $this->assertNotNull($data);
    }

    public function test_failed_findById_data_schedule() {
        $this->controller = new ScheduleController();
        $data = $this->controller->show(0);

        $this->assertNull($data);
    }

    public function test_success_store_data_schedule() {
        $this->controller = new ScheduleController();
        $request = new ScheduleStoreRequest();

        $request['doctor_id'] = fake()->numberBetween(1, 3);
        $response = $this->controller->store($request);

        $this->assertTrue($response);
    }

    public function test_failed_store_data_schedule() {
        $this->controller = new ScheduleController();
        $request = new ScheduleStoreRequest();

        $this->expectException(ValidationException::class);
        $request['doctor_id'] = 'foo';
        $response = $this->controller->store($request);

        $this->assertFalse($response);
    }

    public function test_success_update_data_schedule() {
        $this->controller = new ScheduleController();
        $request = new ScheduleUpdateRequest();

        $request['doctor_id'] = 3;
        $response = $this->controller->update($request, 1);

        $this->assertTrue($response);
    }

    public function test_failed_update_data_schedule() {
        $this->controller = new ScheduleController();
        $request = new ScheduleUpdateRequest();

        $this->expectException(ValidationException::class);
        $request['doctor_id'] = 'bar';
        $response = $this->controller->update($request, 1);

        $this->assertFalse($response);
    }

    public function test_failed_update_data_schedule_wrong_id() {
        $this->controller = new ScheduleController();
        $request = new ScheduleUpdateRequest();

        $request['doctor_id'] = fake()->numberBetween(1, 3);
        $response = $this->controller->update($request, 0);

        $this->assertFalse($response);
    }

    public function test_success_delete_data_schedule() {
        $this->controller = new ScheduleController();
        $response = $this->controller->destroy(4);

        $this->assertTrue($response);
    }

    public function test_failed_delete_data_schedule() {
        $this->controller = new ScheduleController();
        $response = $this->controller->destroy(0);

        $this->assertFalse($response);
    }
}
