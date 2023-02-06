<?php

namespace Tests\Feature;

use App\Http\Requests\StorePattientRequest;
use App\Http\Requests\UpdatePattientRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\PattientService;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PattientTest extends TestCase
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

    public function test_all()
    {
        $service = new PattientService();
        $data = $service->findAll();
        $this->assertNotNull($data);
    }

    public function test_store_in_service()
    {
        $service = new PattientService();
        $request = new StorePattientRequest();
        $request['name'] =  $this->faker->name();
        $request['email'] = $this->faker->email();
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "05607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $res =  $service->store($request->validate($request->rules()));
        $this->assertTrue($res);
    }

    public function test_store_error_validation(){

        $this->expectException(ValidationException::class);
        $service = new PattientService();
        $request = new StorePattientRequest();
        $request['name'] =  $this->faker->name();
        $request['email'] = "email";
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "05607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $res =  $service->store($request->validate($request->rules()));
        $this->assertFalse($res);
    }

    public function test_find_by_id_success(){
        $service = new PattientService();
        $data = $service->findById(1);
        $this->assertNotNull($data);
    }
    public function test_find_by_id_not_found(){
        $service = new PattientService();
        $data = $service->findById(10000);
        $this->assertNull($data);
    }
    public function test_update_in_service_success(){
        $service = new PattientService();
        $request = new UpdatePattientRequest();
        $request['name'] =  $this->faker->name();
        $request['email'] = $this->faker->email();
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "05607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $res =  $service->update($request->validate($request->rules()) , 2);
        $this->assertTrue($res['status']);
        $this->assertArrayHasKey("message" , $res);
        $this->assertEquals("berhasil memperbarui data pasien", $res['message']);
    }

    public function test_update_in_service_failed_cause_email_duplicate(){
        $service = new PattientService();
        $request = new UpdatePattientRequest();
        $request['name'] =  $this->faker->name();
        $request['email'] = "zam@gmail.com";
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "05607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $res =  $service->update($request->validate($request->rules()) , 2);
        $this->assertfalse($res['status']);
        $this->assertArrayHasKey("message" , $res);
    }
    public function test_update_in_service_success_with_older_email(){
        $service = new PattientService();
        $request = new UpdatePattientRequest();
        $request['name'] =  $this->faker->name();
        $request['email'] = "phane@hotmail.com";
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "05607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "new pekerjaan";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $res =  $service->update($request->validate($request->rules()) , 2);
        $this->assertTrue($res['status']);
        $this->assertArrayHasKey("message" , $res);
    }

    public function test_delete_pattient_in_service(){
        $service = new PattientService();
        $res = $service->deleteById(2);
        $this->assertTrue($res);
    }
}
