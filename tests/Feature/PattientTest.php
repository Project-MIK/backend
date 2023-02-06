<?php

namespace Tests\Feature;

use App\Http\Requests\StorePattientRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\PattientService;
use Carbon\Carbon;
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
        $request['phone_number'] = "085607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $service->store($request->validate($request->rules()));
    }
}
