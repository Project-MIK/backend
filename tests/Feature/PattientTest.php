<?php

namespace Tests\Feature;

use App\Helpers\Helper;
use App\Http\Requests\StorePattientMedicalRequest;
use App\Http\Requests\StorePattientRequest;
use App\Http\Requests\UpdatePattientRequest;
use App\Models\Pattient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\PattientService;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
        $request['fullname'] = $this->faker->name();
        $request['email'] = $this->faker->email();
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "05607185972";
        $request['address_RT'] = 01;
        $request['address_RW'] = 02;
        $request['address_desa'] = 'yosomulyo';
        $request['address_dusun'] = 'sidoarjo';
        $request['address_kecamatan'] = 'gambiaran';
        $request['address_kabupaten'] = 'banyuwangi';
        $request['citizen'] = "WNI";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $request["nik"] = 123123;
        $res = $service->store($request->validate($request->rules()['nik']));
        $this->assertTrue($res);
    }
    public function test_store_error_validation()
    {
        $this->expectException(ValidationException::class);
        $service = new PattientService();
        $request = new StorePattientRequest();
        $request['name'] = $this->faker->name();
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
        $res = $service->store($request->validate($request->rules()));
        $this->assertFalse($res);
    }

    public function test_find_by_id_success()
    {
        $service = new PattientService();
        $data = $service->findById(1);
        $this->assertNotNull($data);
    }
    public function test_find_by_id_not_found()
    {
        $service = new PattientService();
        $data = $service->findById(10000);
        $this->assertNull($data);
    }
    public function test_update_in_service_success()
    {
        $service = new PattientService();
        $request = new UpdatePattientRequest();
        $request['name'] = $this->faker->name();
        $request['email'] = $this->faker->email();
        $request['gender'] = "M";
        $request['phone_number'] = "05607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $request['nik'] = 9283092938904203;
        $res = $service->update($request->validate($request->rules()[0]), 2);
        $this->assertTrue($res['status']);
        $this->assertArrayHasKey("message", $res);
        $this->assertEquals("berhasil memperbarui data pasien", $res['message']);
    }

    public function test_update_in_service_failed_cause_email_duplicate()
    {
        $service = new PattientService();
        $request = new UpdatePattientRequest();
        $request['name'] = $this->faker->name();
        $request['email'] = "email@gmail.com";
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "05607185972";
        $request['address'] = $this->faker->address();
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = Carbon::now()->toDateTimeString();
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $request['nik'] = 9283092938904203;
        $res = $service->update($request->validate($request->rules()[0]), 2);
        $this->assertfalse($res['status']);
        $this->assertArrayHasKey("message", $res);
    }
    public function test_update_in_service_success_with_older_email()
    {
        $service = new PattientService();
        $request = new UpdatePattientRequest();
        $request['name'] = $this->faker->name();
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
        $request['nik'] = "2030182387892092";
        $res = $service->update($request->validate($request->rules()[0]), 2);
        $this->assertTrue($res['status']);
        $this->assertArrayHasKey("message", $res);
    }
    public function test_delete_pattient_in_service()
    {
        $service = new PattientService();
        $res = $service->deleteById(6);
        $this->assertTrue($res);
    }

    public function test_delete_pattient_in_service_failed()
    {
        $service = new PattientService();
        $res = $service->deleteById(10);
        $this->assertFalse($res);
    }
    // unit test for controller

    public function test_compare_different_in_db_and_request_update_without_password()
    {
        // test
        $request = new UpdatePattientRequest();
        $request['name'] = "zamz";
        $request['email'] = "email@gmail.com";
        $request['gender'] = "M";
        $request['phone_number'] = "05607185972";
        $request['address'] = "RT/RW : 1/2 Dusun sidoarjo Desa yosomulyo Kec. gambiaran Kab.banyuwangi";
        $request['citizen'] = "WNI";
        $request['profession'] = "guru";
        $request['date_birth'] = "2023-02-08 12:51:41";
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $request['nik'] = 287639876267861;
        $newData = $request->validate($request->rules()[0]);
        $res = Helper::compareToArrays($newData, 10, 'pattient');
        $this->assertFalse($res);
    }
    public function test_update_without_change()
    {
        $request = new UpdatePattientRequest();
        $service = new PattientService();
        $request['name'] = "zamz";
        $request['email'] = "email@gmail.com";
        $request['gender'] = "M";
        $request['phone_number'] = "085607185972";
        $request['address'] = "RT/RW : 1/2 Dusun sidoarjo Desa yosomulyo Kec. gambiaran Kab.banyuwangi";
        $request['citizen'] = "WNI";
        $request['profession'] = "GURU";
        $request['date_birth'] = "2023-02-08 12:51:41";
        $request['blood_group'] = "B";
        $request['place_birth'] = "bwi";
        $request['nik'] = 287639876267861;
        $newData = $request->validate($request->rules()[0]);
        $res = $service->update($newData, 1);
        $this->assertFalse($res['status']);
    }

    public function test_store_Pin_controller()
    {
        $data = [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->email(),
            'gender' => "M",
            'password' => "rahasia",
            'phone_number' => "05607185972",
            'address_RT' => 01,
            'address_RW' => 02,
            'address_desa' => 'yosomulyo',
            'address_dusun' => 'sidoarjo',
            'address_kecamatan' => 'gambiaran',
            'address_kabupaten' => 'banyuwangi',
            'citizen' => "WNI",
            'profession' => "guru",
            'date_birth' => Carbon::now()->toDateTimeString(),
            'blood_group' => "B",
            'place_birth' => "bwi",
            'nik' => mt_rand(1000000000000000, 9999999999999999)
        ];
        // if you need test this route you must have routing 
        $res = $this->post('pattient', $data);
        $res->assertSessionHas('message');
    }

    public function test_store_admin()
    {
        $service = new PattientService();
        $request = new StorePattientMedicalRequest();
        $request['fullname'] = "zamz";
        $request['email'] = "zam@gmaisl.com";
        $request['gender'] = "M";
        $request['password'] = "rahasia";
        $request['phone_number'] = "0867532342";
        $request['address_RT'] = 3;
        $request['address_RW'] = 4;
        $request['address_desa'] = 'bwi';
        $request['address_dusun'] = "kamboja";
        $request['address_kecamatan'] = "kkecas";
        $request['address_kabupaten'] = "dasd";
        $request['citizen'] = "wni";
        $request['profession'] = "guru";
        $request['date_birth'] = "0923423";
        $request['blood_group'] = "A";
        $request['place_birth'] = "bwi";
        $request['rekamMedic'] = "1312321";
        $res = $service->storeWithAdmin($request->validate($request->rules()));
        dd($res);
    }

    public function test_login()
    {
        $service = new PattientService();
        $service->login([
            "no_medical_records" => 123123,
            "password" => 'rahasia'
        ]);

    }

    public function test_insert_with_admin()
    {
        $service = new PattientService();
        $res = $service->storeWithAdmin(
            [
                "fullname" => $this->faker->name(),
                "email" => $this->faker->email(),
                "gender" => "w",
                "password" => "rahasia",
                "phone_number" => "09723212312",
                "address_RT" => 3,
                "address_RW" => 2,
                "address_desa" => "bwi",
                "address_dusun" => "gambiran",
                "address_kecamatan" => "kecamatan",
                "address_kabupaten" => "banyuwangi",
                "citizen" => "wni",
                "proffession" => "guru",
                "date_birth" => "asdas",
                "blood_group" => "B",
                "place_birth" => "banyuwani",
                "medical_record_id" => $this->faker->name(),
                "id_registration_officer" => 1,
            ]
        );
      
    }
    public function test_store_controller(){
        $data = [
            "fullname" => $this->faker->name(),
            "email" => $this->faker->email(),
            "gender" => "w",
            "password" => "rahasia",
            "phone_number" => "09723212312",
            "address_RT" => 3,
            "address_RW" => 2,
            "address_desa" => "bwi",
            "address_dusun" => "gambiran",
            "address_kecamatan" => "kecamatan",
            "address_kabupaten" => "banyuwangi",
            "citizen" => "WNI",
            "profession" => "guru",
            "date_birth" => "asdas",
            "blood_group" => "B",
            "place_birth" => "banyuwani",
            "medical_record_id" => random_int(100000 , 999999),
            "id_registration_officer" => 1,
            "nik" => random_int(1000000000000000 , 9999999999999999)
        ];
        $response = $this->post("rekam" , $data);
        $response->assertSessionHas('message' , "berhasil menambahkan patient , berhasil mengirimkan email");
    }

    public function test_store_controller_wna(){
        $data = [
            "fullname" => $this->faker->name(),
            "email" => $this->faker->email(),
            "gender" => "w",
            "password" => "rahasia",
            "phone_number" => "09723212312",
            "address_RT" => 3,
            "address_RW" => 2,
            "address_desa" => "bwi",
            "address_dusun" => "gambiran",
            "address_kecamatan" => "kecamatan",
            "address_kabupaten" => "banyuwangi",
            "citizen" => "WNA",
            "profession" => "guru",
            "date_birth" => "asdas",
            "blood_group" => "B",
            "place_birth" => "banyuwani",
            "medical_record_id" => random_int(100000 , 999999),
            "id_registration_officer" => 1,
            "no_paspor" => random_int(1000000000000000 , 9999999999999999)
        ];
        $response = $this->post("rekam" , $data);
        $response->assertSessionHas('message' , "berhasil menambahkan patient , berhasil mengirimkan email");
    }
}