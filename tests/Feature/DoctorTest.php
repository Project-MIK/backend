<?php

namespace Tests\Feature;

use App\Http\Controllers\DoctorController;
use App\Http\Requests\DoctorRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    private DoctorController $controller;

    public function test_success_findAll_data_doctors() {
        $this->controller = new DoctorController();
        $response = $this->controller->index();

        $this->assertNotNull($response);
    }

    public function test_failed_findAll_data_doctors() {
        $this->controller = new DoctorController();
        $response = $this->controller->index();

        $this->assertNull($response);
    }

    public function test_success_findById_data_polyclinic()
    {
        $this->controller = new DoctorController();
        $response = $this->controller->show(3);
        $this->assertNotNull($response);
    }

    public function test_failed_findById_data_polyclinic()
    {
        $this->controller = new DoctorController();
        $response = $this->controller->show(99);
        $this->assertNull($response);
    }

    public function test_success_store_data_doctor()
    {
        $this->controller = new DoctorController();
        $request = new DoctorRequest();

        $request['name'] = fake()->name("male");
        $request['gender'] = "M";
        $request['address'] = fake()->address();
        $request['phone'] = 123412341234;
        $request['polyclinic_id'] = 2;

        $response = $this->controller->store($request);
        $this->assertTrue($response);
    }
    public function test_failed_store_data_doctor()
    {
        $this->controller = new DoctorController();
        $request = new DoctorRequest();

        $this->expectException(ValidationException::class);
        $request['name'] = fake()->name("male");
        $request['gender'] = "E";
        $request['address'] = fake()->address();
        $request['phone'] = 123412341234;
        $request['polyclinic_id'] = fake()->numberBetween(11, 14);

        $response = $this->controller->store($request);
        $this->assertFalse($response);
    }

    public function test_success_update_data_doctor()
    {
        $this->controller = new DoctorController();
        $request = new DoctorRequest();

        $request['name'] = fake()->name("male");
        $request['gender'] = "W";
        $request['address'] = fake()->address();
        $request['phone'] = 123412341234;
        // $request['polyclinic_id'] = fake()->numberBetween(11, 14);
        $request['polyclinic_id'] = 2;

        $response = $this->controller->update($request, 1);
        $this->assertTrue($response);
    }

    public function test_failed_update_data_doctor()
    {
        $this->controller = new DoctorController();
        $request = new DoctorRequest();

        $request['name'] = fake()->name("male");
        $request['gender'] = "W";
        $request['address'] = fake()->address();
        $request['phone'] = 123412341234;
        $request['polyclinic_id'] = fake()->numberBetween(11, 14);

        $response = $this->controller->update($request, 0);
        $this->assertFalse($response);
    }

    public function test_success_delete_data_doctor()
    {
        $this->controller = new DoctorController();
        $response = $this->controller->destroy(3);

        $this->assertTrue($response);
    }

    public function test_failed_delete_data_doctor()
    {
        $this->controller = new DoctorController();
        $response = $this->controller->destroy(0);

        $this->assertFalse($response);
    }
    
    public function test_success_searchByGender_data_polyclinic() {
        $this->controller = new DoctorController();

        $data = $this->controller->searchByGender("M");

        $this->assertNotNull($data);
    }
    
    public function test_failed_searchByGender_data_polyclinic() {
        $this->controller = new DoctorController();

        $data = $this->controller->searchByGender("E");

        $this->assertNull($data);
    }
}
