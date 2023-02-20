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
            "medical_record_id" => 123123,
            "description" => "mengalami ganguan sakit kepala" , 
            "complaint" => "sakit kepala" , 
        ]);
    }
}
