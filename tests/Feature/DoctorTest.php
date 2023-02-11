<?php

namespace Tests\Feature;

use App\Http\Controllers\DoctorController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    private DoctorController $controller;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

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
}
