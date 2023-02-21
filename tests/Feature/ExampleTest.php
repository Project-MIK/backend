<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Helpers\Helper;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_difference(){
        $res = Helper::compareToArrays(["name" => "pattint"], 1, "pattient");
        $this->assertTrue($res);
    }

    public function test_send_email(){
        $res = $this->get("rekam-medic/email");
        dd($res);
    }
}
