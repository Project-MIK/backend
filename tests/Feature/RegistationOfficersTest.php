<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class RegistationOfficersTest extends TestCase
{
    use WithFaker;

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
    public function test_can_create_store(){
        $data = [
            'name' => $this->faker->name,
            "email" => $this->faker->email(),
            "password" => bcrypt('screet'),
            "gender" => "M" , 
            "address" => $this->faker->address
        ];
        Session::start();
        $response = $this->post("/officers", $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertSessionHas(["message" => "Berhasil menambahkan pegawai"]);
    }
    public function test_cant_store_cause_error_validations(){
        $data = [
            'name' => $this->faker->name,
            "email" => "error email ",
            "password" => bcrypt('screet'),
            "gender" => "M" , 
            "address" => $this->faker->address
        ];
        $response = $this->post("/officers", $data);
        $errors = session('errors');
        $response->assertSessionHasErrors(["email" => "email harus menggunakan email yang valid"]);
    }
    public function test_cant_store_cause_double_email_in_validation(){
        $data = [
            'name' => $this->faker->name,
            "email" => "zulauf.faye@yahoo.com",
            "password" => bcrypt('screet'),
            "gender" => "M" , 
            "address" => $this->faker->address
        ];
        $response = $this->post("/officers", $data);
        $errors = session('errors');
        $response->assertSessionHasErrors(["email" => "email sudah digunakan."]);
    }

    public function test_get_edit(){
        $response = $this->get('/officers/100/edit');
        $response->assertStatus(200);
    }

    public function test_update_data_success(){
        $data = [
            'name' => $this->faker->name,
            "email" => $this->faker->email(),
            "password" => "rahasia",
            "gender" => "M" , 
            "address" => $this->faker->address
        ];
        Session::start();
        $response = $this->put("/officers/5" , $data);
        $response->assertSessionHas("message" , "berhasil memperbarui data pegawai registration");
    }

    public function test_cant_update_data_cause_error_validation(){
        $data = [
            'name' => $this->faker->name,
            "email" => "email",
            "password" => "rahasia",
            "gender" => "M" , 
            "address" => $this->faker->address
        ];
        Session::start();
        $response = $this->put("/officers/5" , $data);
        $response->assertSessionHasErrors(["email"]);
    }
    public function test_succes_delete_data(){
        Session::start();
        $response = $this->call("DELETE", "/officers/5" , ['_token' => csrf_token()]);
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas("message");
    }
}
