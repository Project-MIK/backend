<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MedicalRecordControllerTest extends TestCase
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

    
    public function test_store_success()
    {
        $data = [
            "medical_record_id" => (random_int(100000, 999999)), 
            "id_pattient" => 1 ,
            "id_registration_officer" => 1 
        ];
        $res = $this->post("rekam-medic" , $data);
        $res->assertSessionHas('message' , "berhasil menambahkan rekam medis pasien");
    }

    public function test_find_passient(){
        $res = $this->get("rekam-medic/0koaso");
        $this->assertArrayHasKey("medical_record_id" , $res->original);
    }

    public function test_delete_by_id(){
        $id = (random_int(100000, 999999));
        $data = [
            "medical_record_id" => $id, 
            "id_pattient" => 1 ,
            "id_registration_officer" => 1 
        ];
        $this->post("rekam-medic" , $data);
        $res = $this->call('delete' , "rekam-medic/$id");
        $res->assertSessionHas("message" , "berhasil menghapus rekam medis");
    }

}
