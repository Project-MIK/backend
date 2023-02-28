<?php

namespace Database\Seeders;

use App\Models\Record;
use Carbon\Carbon;
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
            "id_schedules" => 1,
            "id_category" => 1,
            'status' => "consultation-complete",
            'valid_status' => Carbon::now()->addHours(1)
        ]);
        // Record::create([
        //     "id" => "KL0923310",
        //     "medical_record_id" => 123123,
        //     "description" => "mengalami ganguan sakit kepala" , 
        //     "complaint" => "sakit kepala" , 
        //     "id_doctor" => 1 , 
        //     "id_schedules" => 1,
        //     "id_category" => 1,
        //     'status' => "confirmed-consultation-payment"
        // ]);
        Record::create([
            "id" => "KL2039824",
            "medical_record_id" => 123123,
            "description" => "mengalami ganguan sakit kepala" , 
            "complaint" => "sakit kepala" , 
            "id_doctor" => 1 , 
            "id_schedules" => 2,
            "id_category" => 1
        ]);
    }
}
