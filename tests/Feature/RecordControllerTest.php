<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordControllerTest extends TestCase
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

    public function test_store_success(){
        $data = [
            "description" => "description insi", 
            "medical_record_id" => 123123 , 
            "id_doctor" => 1 , 
            "complaint" => "oke" , 
        ];
        $res = $this->post("detail" , $data);
        $res->assertSessionHas("message" , "berhasil menambahkan detail rekam medic");
    }

    public function test_store_failed(){
        $data = [
            "description" => "description ini", 
            "medical_record_id" => 12312, 
            "id_doctor" => 1 , 
            "complaint" => "oke" , 
        ];
        $res = $this->post("detail" , $data);
        $res->assertSessionHas("message" , "gagal menambahkan detail rekam medic , rekam medic tidak ditemukan");
    }
}
