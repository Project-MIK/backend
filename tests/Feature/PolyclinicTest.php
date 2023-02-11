<?php

namespace Tests\Feature;

use App\Http\Controllers\PolyclinicController;
use App\Http\Requests\PolyclinicRequest;
use App\Models\Polyclinic;
use App\Services\PolyclinicService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PolyclinicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private PolyclinicController $controller;

    // public function __construct()
    // {
    //     $this->controller = new PolyclinicController();
    // }

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
        $response = $this->controller->show(11);
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
        $request = new PolyclinicRequest();

        $request['name'] = fake()->words(2, true);
        $data = $this->controller->store($request);
        $this->assertEquals(true, $data);
    }

    public function test_failed_store_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicRequest();

        $request['name'] = fake()->randomNumber(2);
        $data = $this->controller->store($request);
        $this->assertEquals(false, $data);
    }

    public function test_update_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicRequest();

        $request['name'] = fake()->words(2, true);
        $response = $this->controller->update($request, 11);

        $this->assertEquals(true, $response);
    }

    public function test_failed_update_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicRequest();

        $request['name'] = fake()->words(2, true);
        $response = $this->controller->update($request, 99);

        $this->assertEquals(false, $response);
    }

    public function test_success_delete_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->destroy(7);

        $this->assertEquals(true, $response);
    }

    public function test_failed_delete_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->destroy(99);

        $this->assertEquals(false, $response);
    }

    public function test_success_searchByName_data_polyclinic() {
        $this->controller = new PolyclinicController();

        $data = $this->controller->searchByName("atque iure");

        $this->assertNotNull($data);
    }

    public function test_failed_searchByName_data_polyclinic() {
        $this->controller = new PolyclinicController();

        $data = $this->controller->searchByName("99");

        $this->assertNull($data);
    }

    public function test_success_service_findById() {
        $service = new PolyclinicService();

        $data = $service->findById(1);

        $this->assertNotNull($data);
    }

    public function test_failed_service_findById() {
        $service = new PolyclinicService();

        $data = $service->findById(99);

        $this->assertNull($data);
    }
}
