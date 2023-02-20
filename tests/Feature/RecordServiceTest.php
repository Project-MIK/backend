<?php

namespace Tests\Feature;

use App\Models\Record;
use App\Services\RecordService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordServiceTest extends TestCase
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



    public function test_return_as_array()
    {
        $service = new RecordService();
        $res = $service->index();
        $this->assertIsArray($res);
    }

    public function test_insert_data()
    {
        $data = [
            "medical_record_id" => 123123,
            "description" => "ini desc",
            "complaint" => "ini complaint"
        ];
        $service = new RecordService();
        $res = $service->insert($data);
        $this->assertDatabaseHas("record", $data);
    }

    public function test_find_detail_record_by_rekam_medic()
    {
        $service = new RecordService();
        $res = $service->findByMedicalRecord(123123);
        $this->assertArrayHasKey("medical_record_id", $res[0]);
    }

    public function test_find_detail_record_null()
    {
        $service = new RecordService();
        $res = $service->findByMedicalRecord(31233123123);
        $this->assertArrayNotHasKey("medical_record_id", $res);
    }


    public function test_update_success()
    {
        $service = new RecordService();
        $data = [
            "complaint" => "zam",
            "description" => "oke"
        ];
        $res = $service->update([
            "complaint" => $this->faker->name(),
            "description" => "oke"
        ], 1);
        $this->assertTrue($res['status']);
    }

    public function test_delete_by_id_success()
    {
        $service = new RecordService();
        $ok  = Record::create([
            "medical_record_id" => 123123,
            "description" => "mengalami ganguan sakit kepala",
            "complaint" => "sakit kepala",
        ]);
        $res = $service->delete($ok->id);
        $this->assertTrue($res['status']);
    }
}