<?php

namespace Tests\Feature;

use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session as FacadesSession;
use Tests\TestCase;

class AdminTest extends TestCase
{
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

    public function test_get_return_index_as_array()
    {
        $response = $this->get("/admin");
        $response->assertStatus(200);
    }

    public  function test_update_data()
    {
        $data = [
            "name" => "admins",
            "password" => "rahasia",
            "email" => "admin@gmail.com",
            "address" => "bwi"
        ];
        $response = $this->put("/admin/7", $data);
        FacadesSession::start();
        $response->assertSessionHas("message", "berhasil update");
    }

    public function test_insert_data_error_email_format()
    {
        $data = [
            "name" => "admin",
            "password" => "rahasia",
            "email" => "erorr email",
            "address" => "bwi"
        ];
        $response = $this->post("/admin", $data);
        $response->assertSessionHasErrors("email");
    }

    public function test_insert_error_duplicate_email()
    {
        $data = [
            "name" => "admin",
            "password" => "rahasia",
            "email" => "admin@gmail.com",
            "address" => "bwi"
        ];
        $response = $this->post("/admin", $data);
        $response->assertSessionHasErrors("email");
    }

    public function test_delete()
    {
        $response = $this->call("DELETE", "/admin/6",  ['_token' => csrf_token()]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_delete_not_found(){
        $response = $this->call("DELETE", "/admin/10000",  ['_token' => csrf_token()]);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
