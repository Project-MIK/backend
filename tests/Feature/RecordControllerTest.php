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


    public function test_store(){
        $data = [
            "description" => "description ini", 
            "medical_record_id" => 12 , 
            "id_doctor" => 1 , 
            "complaint" => "oke" , 
        ];
        $res = $this->post("detail" , $data);
        dd($res);
    }
}
