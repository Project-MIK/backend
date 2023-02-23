<?php

namespace Database\Seeders;

use App\Models\Record;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Record::create([
            "id" => "KL0923210",
            "medical_record_id" => 123123,
            "description" => "mengalami ganguan sakit kepala" , 
            "complaint" => "sakit kepala" , 
            "id_doctor" => 1 , 
            "id_schedules" => 1
        ]);
        Record::create([
            "id" => "KL2039824",
            "medical_record_id" => 123123,
            "description" => "mengalami ganguan sakit kepala" , 
            "complaint" => "sakit kepala" , 
            "id_doctor" => 1 , 
            "id_schedules" => 1
        ]);
    }
}
