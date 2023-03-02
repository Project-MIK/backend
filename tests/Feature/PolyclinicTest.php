<?php

namespace Tests\Feature;

use App\Http\Controllers\PolyclinicController;
use App\Http\Requests\PolyclinicStoreRequest;
use App\Http\Requests\PolyclinicUpdateRequest;
use App\Services\PolyclinicService;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PolyclinicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private PolyclinicController $controller;

    public function test_findAll_data_polyclinics()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->index();
        $this->assertNotNull($response);
    }

    public function test_failed_findAll_data_polyclinics()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->index();
        $this->assertNull($response);
    }

    public function test_success_findById_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->show(1);
        $this->assertNotNull($response);
    }

    public function test_failed_findById_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->show(99);
        $this->assertNull($response);
    }

    public function test_success_store_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicStoreRequest();

        $request['name'] = fake()->words(2, true);
        $request['category_id'] = fake()->numberBetween(1, 3);
        $data = $this->controller->store($request);
        $this->assertTrue($data);
    }

    public function test_failed_store_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicStoreRequest();

        $this->expectException(ValidationException::class);
        $request['name'] = fake()->randomNumber(2);
        $request['category_id'] = fake()->numberBetween(1, 3);
        $data = $this->controller->store($request);

        $this->assertFalse($data);
    }

    public function test_success_update_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicUpdateRequest();

        $request['name'] = fake()->words(2, true);
        $request['category_id'] = fake()->numberBetween(1, 3);
        $response = $this->controller->update($request, 1);

        $this->assertTrue($response);
    }

    public function test_failed_update_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicUpdateRequest();

        $request['name'] = fake()->words(2, true);
        $request['category_id'] = fake()->numberBetween(1, 3);
        $response = $this->controller->update($request, 0);
        $this->assertFalse($response);
    }

    public function test_failed_update_data_polyclinic_validation()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicUpdateRequest();
        $this->expectException(ValidationException::class);

        $request['name'] = 99;
        $request['category_id'] = fake()->numberBetween(1, 3);
        $response = $this->controller->update($request, 12);
        $this->assertFalse($response);
    }

    public function test_success_delete_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->destroy(1);

        $this->assertTrue($response);
    }

    public function test_failed_delete_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->destroy(99);

        $this->assertFalse($response);
    }

    public function test_success_searchByName_data_polyclinic() {
        $this->controller = new PolyclinicController();

        $data = $this->controller->searchByName("facere quo");

        $this->assertNotNull($data);
    }

    public function test_failed_searchByName_data_polyclinic() {
        $this->controller = new PolyclinicController();

        $data = $this->controller->searchByName("99");

        $this->assertNull($data);
    }

    public function test_success_service_findById() {
        $service = new PolyclinicService();

        $data = $service->findById(2);

        $this->assertNotNull($data);
    }

    public function test_failed_service_findById() {
        $service = new PolyclinicService();

        $data = $service->findById(99);

        $this->assertNull($data);
    }
}
