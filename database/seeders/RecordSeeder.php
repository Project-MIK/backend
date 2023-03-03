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
            "description" => "mengalami ganguan sakit kepala complete" , 
            "complaint" => "sakit kepala" , 
            "doctor_id" => 1 , 
            "schedule_id" => 1,
            "id_category" => 1,
            'status_consultation' => "consultation-complete",
            'valid_status' => Carbon::now(),
            'bukti' => 'crPpMrq4pf9w.UyqHeG5Jl3qwo.gvoZeNzgGV4T1V1396QYRW.png',
            'status_payment_consultation' => 'TERKONFIRMASI'
        ]);
    }
}
