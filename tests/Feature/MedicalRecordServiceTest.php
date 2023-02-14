<?php

namespace Tests\Feature;

use App\Models\Pattient;
use App\Services\MedicalRecordService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Iluminate\Support\Str;

class MedicalRecordServiceTest extends TestCase
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


    public function test_get_data()
    {
        $service = new MedicalRecordService();
        $res = $service->findAll();
        $this->assertNotNull($res);
    }

    public function test_store_success()
    {
        $resUser = Pattient::factory()->create();
        $randomNumber = (int) (random_int(100000, 999999));
        $request = [
            "medical_record_id" =>  $randomNumber,
            "id_pattient" => $resUser->id,
            "id_registration_officer" => 1
        ];
        $service = new MedicalRecordService();
        $res = $service->insert($request);
        $this->assertTrue($res);
    }

    public function test_insert_failed()
    {
        $resUser = Pattient::factory()->create();
        $request = [
            "medical_record_id" =>  "0koaso",
            "id_pattient" => $resUser->id,
            "id_registration_officer" => 1
        ];
        $service = new MedicalRecordService();
        $res = $service->insert($request);
        $this->assertFalse($res);
    }

    public function test_insert_failed_if_patient_not_found()
    {
        $randomNumber = (int) (random_int(100000, 999999));
        $request = [
            "medical_record_id" =>  $randomNumber,
            "id_pattient" => 123123123,
            "id_registration_officer" => 1
        ];
        $service = new MedicalRecordService();
        $res = $service->insert($request);
        $this->assertFalse($res);
    }

    public function test_insert_failed_if_id_registration_officers_not_found()
    {
        $randomNumber = (int) (random_int(100000, 999999));
        $request = [
            "medical_record_id" =>  $randomNumber,
            "id_pattient" => 1,
            "id_registration_officer" => 1000000
        ];
        $service = new MedicalRecordService();
        $res = $service->insert($request);
        $this->assertFalse($res);
    }


    public function test_find_by_id_success()
    {
        $service = new MedicalRecordService();
        $res = $service->findById("0koaso");
        $this->assertNotNull($res);
    }

    public function test_find_by_id_not_found()
    {
        $service = new MedicalRecordService();
        $res = $service->findById("not found id");
        $this->assertNull($res);
    }


    public function test_update_medical_records()
    {
        $service = new MedicalRecordService();
        $data = [
            "id_pattient" => 8,
            "id_registration_officer" => 1,
        ];
        $res = $service->update($data, "741952");
        $this->assertTrue($res['status']);
    }
    public function test_update_medical_records_failed()
    {
        $service = new MedicalRecordService();
        $data = [
            "id_pattient" => 10,
            "id_registration_officer" => 1,
        ];
        $res = $service->update($data, "741952");
        $this->assertFalse($res['status']);
    }

    public function test_delete_success()
    {
        $service = new MedicalRecordService();
        $resUser = Pattient::factory()->create();
        $randomNumber = (int) (random_int(100000, 999999));
        $request = [
            "medical_record_id" =>  $randomNumber,
            "id_pattient" => $resUser->id,
            "id_registration_officer" => 1
        ];
        $service = new MedicalRecordService();
        $res = $service->insert($request);
        if($res){
            $resDelete = $service->deleteById($randomNumber);
            $this->assertTrue($resDelete);
        }
    }
}
