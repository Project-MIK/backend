<?php

namespace Tests\Feature;

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
    public function test_example()
    {
        $response = $this->get('/polyclinics');

        $response->assertStatus(200);
    }

    public function test_success_store_data_polyclinic()
    {
        $response = $this->post('/polyclinics', [
            'name' => 'testOK'
        ]);

        $response->assertOk();
    }

    public function test_failed_store_data_polyclinic()
    {
        $response = $this->post('/polyclinics', [
            'name' => 800
        ]);

        $response->assertInvalid();
    }

    public function test_success_update_data_polyclinic()
    {
        $response = $this->put('/polyclinics/8', [
            'name' => 'testSuccess'
        ]);

        $response->assertOk();
    }

    public function test_failed_update_data_polyclinic()
    {
        $response = $this->put('/polyclinics/5', [
            'name' => 800
        ]);

        $response->assertInvalid();
    }

    public function test_success_delete_data_polyclinic()
    {
        $response = $this->delete('/polyclinics/5');

        $response->assertOk();
    }
}
