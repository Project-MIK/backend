<?php

namespace Tests\Feature;

use App\Http\Requests\RegistrationOfficersRequest;
use App\Models\RegistrationOfficers;
use App\Services\RegistrationOfficerService;
use Dotenv\Exception\ValidationException;
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
    public function test_can_create_store()
    {
        $data = [
            'name' => $this->faker->name,
            "email" => $this->faker->email(),
            "password" => bcrypt('screet'),
            "gender" => "M",
            "address" => $this->faker->address
        ];
        Session::start();
        $response = $this->post("/officers", $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertSessionHas(["message" => "Berhasil menambahkan pegawai"]);
    }
    public function test_cant_store_cause_error_validations()
    {
        $data = [
            'name' => $this->faker->name,
            "email" => "error email ",
            "password" => bcrypt('screet'),
            "gender" => "M",
            "address" => $this->faker->address
        ];
        $response = $this->post("/officers", $data);
        $errors = session('errors');
        $response->assertSessionHasErrors(["email" => "email harus menggunakan email yang valid"]);
    }
    public function test_cant_store_cause_double_email_in_validation()
    {
        $data = [
            'name' => $this->faker->name,
            "email" => "zulauf.faye@yahoo.com",
            "password" => bcrypt('screet'),
            "gender" => "M",
            "address" => $this->faker->address
        ];
        $response = $this->post("/officers", $data);
        $errors = session('errors');
        $response->assertSessionHasErrors(["email" => "email sudah digunakan."]);
    }

    public function test_get_edit()
    {
        $response = $this->get('/officers/100/edit');
        $response->assertStatus(200);
    }

    public function test_update_data_success()
    {
        $data = [
            'name' => $this->faker->name,
            "email" => $this->faker->email(),
            "password" => "rahasia",
            "gender" => "M",
            "address" => $this->faker->address
        ];
        Session::start();
        $response = $this->put("/officers/5", $data);
        $response->assertSessionHas("message", "berhasil memperbarui data pegawai registration");
    }

    public function test_cant_update_data_cause_error_validation()
    {
        $data = [
            'name' => $this->faker->name,
            "email" => "email",
            "password" => "rahasia",
            "gender" => "M",
            "address" => $this->faker->address
        ];
        Session::start();
        $response = $this->put("/officers/5", $data);
        $response->assertSessionHasErrors(["email"]);
    }
    public function test_succes_delete_data()
    {
        Session::start();
        $response = $this->call("DELETE", "/officers/5", ['_token' => csrf_token()]);
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas("message");
    }

    // test service class

    public function test_get_data_in_service()
    {
        $service = new RegistrationOfficerService();
        $response = $service->findAll();
        $this->assertNotNull($response);
    }

    public function test_get_data_null_in_service()
    {
        $service = new RegistrationOfficerService();
        $res = $service->findAll();
        $this->assertNull($res);
    }

    public function test_insert_data_in_service_success()
    {
        $service = new RegistrationOfficerService();
        $request = new RegistrationOfficersRequest();
        $request['name'] = $this->faker->name();
        $request['email'] = $this->faker->email();
        $request['address'] = $this->faker->address();
        $request['password'] ="rahasia";
        $request['gender'] = "M";
        $res = $service->store($request->validate($request->rules()));
        $this->assertNotNull($res);
    }
    public function test_insert_data_in_service_failed()
    {
        $service = new RegistrationOfficerService();
        $request = new RegistrationOfficersRequest();
        // has validation exception
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $request['name'] = $this->faker->name();
        $request['email'] = "email";
        $request['address'] = $this->faker->address();
        $request['password'] = "rahasia";
        $request['gender'] = "M";
        $res = $service->store($request->validate($request->rules()));
        $this->assertnull($res);
    }

    public function test_find_by_id_in_service()
    {
        $servicec = new RegistrationOfficerService();
        $data = $servicec->findById(3);
        $this->assertNotNull($data);
    }

    public function test_find_by_id_in_service_null()
    {
        $servicec = new RegistrationOfficerService();
        $data = $servicec->findById(100000);
        $this->assertNull($data);
    }

    public function test_update_data_in_service_with_same_email()
    {
        $service = new RegistrationOfficerService();
        $request = new RegistrationOfficersRequest();
        $request['name'] = "oke";
        $request['email'] = "francisca65@gmail.com";
        $request['address'] = $this->faker->address();
        $request['password'] = "rahasia";
        $request['gender'] = "M";
        $res =  $service->update($request->validate([
            "email" => ['required', 'email'],
            "name" => ['required', 'string'],
            "password" => ['required', 'min:6'],
            "address" => ['required', 'string'],
            "gender" => ['required']
        ]), 2);
        $this->assertFalse($res);
    }

    public function test_update_data_in_service_with_different_email()
    {
        $service = new RegistrationOfficerService();
        $request = new RegistrationOfficersRequest();
        $request['name'] = "ok ngab";
        $request['email'] = "diff@gmail.com";
        $request['address'] = $this->faker->address();
        $request['password'] = "rahasia";
        $request['gender'] = "M";
        $res =  $service->update($request->validate([
            "email" => ['required', 'email'],
            "name" => ['required', 'string'],
            "password" => ['required', 'min:6'],
            "address" => ['required', 'string'],
            "gender" => ['required']
        ]), 3);
        $this->assertTrue($res);
    }

    public function test_delete_in_service_success()
    {
        $service = new RegistrationOfficerService();
        $res = $service->deleteById(2);
        $this->asserttrue($res);
    }

    public function test_delete_in_service_notfound()
    {
        $service = new RegistrationOfficerService();
        $res = $service->deleteById(10000);
        $this->assertfalse($res);
    }
}
