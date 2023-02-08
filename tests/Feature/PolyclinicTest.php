<?php

namespace Tests\Feature;

use App\Http\Controllers\PolyclinicController;
use App\Http\Requests\PolyclinicRequest;
use App\Models\Polyclinic;
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

    public function test_findAll_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $response = $this->controller->index();
        $this->assertNotNull($response);
    }

    public function test_success_findById_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $polyclinic = new Polyclinic();
        $polyclinic['id'] = 1;
        $response = $this->controller->show($polyclinic);
        $this->assertNotNull($response);
    }

    public function test_store_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicRequest();

        $request['name'] = fake()->words(2, true);
        $data = $this->controller->store($request);
        $this->assertEquals(true, $data);
    }

    public function test_update_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicRequest();
        $polyclinic = new Polyclinic();

        $request['name'] = fake()->words(2, true);
        $polyclinic['id'] = 15;
        $response = $this->controller->update($request, $polyclinic);

        $this->assertEquals(true, $response);
    }

    public function test_failed_update_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $request = new PolyclinicRequest();
        $polyclinic = new Polyclinic();

        $request['name'] = fake()->words(2, true);
        $polyclinic['id'] = 3;
        $response = $this->controller->update($request, $polyclinic);

        $this->assertNotNull($response);
    }

    public function test_success_delete_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $polyclinic = new Polyclinic();

        $polyclinic['id'] = 22;
        $response = $this->controller->destroy($polyclinic);

        $this->assertEquals(true, $response);
    }

    public function test_failed_delete_data_polyclinic()
    {
        $this->controller = new PolyclinicController();
        $polyclinic = new Polyclinic();

        $polyclinic['id'] = 10;
        $response = $this->controller->destroy($polyclinic);

        $this->assertEquals(false, $response);
    }
}
