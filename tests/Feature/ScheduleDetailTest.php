<?php

namespace Tests\Feature;

use App\Http\Controllers\ScheduleDetailController;
use App\Http\Requests\ScheduleDetailStoreRequest;
use App\Http\Requests\ScheduleDetailUpdateRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ScheduleDetailTest extends TestCase
{
    private ScheduleDetailController $controller;
    
    public function test_success_findAll_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $data = $this->controller->index();

        $this->assertNotNull($data);
    }

    public function test_failed_findAll_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $data = $this->controller->index();

        $this->assertNull($data);
    }

    public function test_success_store_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $request = new ScheduleDetailStoreRequest();

        $request['consultation_date'] = fake()->date();
        $request['time_start'] = fake()->time();
        $request['time_end'] = fake()->time();
        $request['link'] = "www.youtube.com";
        $request['status'] = "kosong";
        $request['schedule_id'] = fake()->numberBetween(1, 3);
        $response = $this->controller->store($request);

        $this->assertTrue($response);
    }

    public function test_failed_store_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $request = new ScheduleDetailStoreRequest();

        $this->expectException(ValidationException::class);
        $request['consultation_date'] = fake()->date();
        $request['time_start'] = fake()->time();
        $request['time_end'] = fake()->time();
        $request['link'] = "www.youtube.com";
        $request['status'] = "kosong";
        $request['schedule_id'] = "foo";
        $response = $this->controller->store($request);

        $this->assertFalse($response);
    }

    public function test_success_findById_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $data = $this->controller->show(1);

        $this->assertNotNull($data);
    }

    public function test_failed_findById_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $data = $this->controller->show(0);

        $this->assertNull($data);
    }

    public function test_success_update_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $request = new ScheduleDetailUpdateRequest();

        $request['consultation_date'] = fake()->date();
        $request['time_start'] = fake()->time();
        $request['time_end'] = fake()->time();
        $request['link'] = "www.youtube.com";
        $request['status'] = "terisi";
        $request['schedule_id'] = fake()->numberBetween(1, 3);
        $response = $this->controller->update($request, 4);

        $this->assertTrue($response);
    }

    public function test_failed_update_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $request = new ScheduleDetailUpdateRequest();

        $this->expectException(ValidationException::class);
        $request['consultation_date'] = fake()->date();
        $request['time_start'] = fake()->time();
        $request['time_end'] = fake()->time();
        $request['link'] = "www.youtube.com";
        $request['status'] = "bar";
        $request['schedule_id'] = fake()->numberBetween(1, 10);
        $response = $this->controller->update($request, 4);

        $this->assertFalse($response);
    }

    public function test_success_delete_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $response = $this->controller->destroy(4);

        $this->assertTrue($response);
    }

    public function test_failed_delete_data_schedule_detail()
    {
        $this->controller = new ScheduleDetailController();
        $response = $this->controller->destroy(0);

        $this->assertFalse($response);
    }
}
