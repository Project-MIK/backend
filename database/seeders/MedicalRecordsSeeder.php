<?php

namespace Database\Seeders;

use App\Models\MedicalRecords;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MedicalRecords::Create([
            "medical_record_id" => "123123",
            "id_registration_officer" => 1
        ]);
    }
}
