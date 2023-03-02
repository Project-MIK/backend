<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('schedule_detail')->insert([
            'id_schedule' => 1,
            "consultation_date" => Carbon::now()->toDateTimeString(),
            "time_start" => Carbon::now()->addHour(),
            "time_end" => Carbon::now()->addHours(2),
            "link" =>  "link jitsi" , 
            "status" => "kosong" , 
        ]);
        DB::table('schedule_detail')->insert([
            'id_schedule' => 1,
            "consultation_date" => Carbon::now()->toDateTimeString(),
            "time_start" => Carbon::now(),
            "time_end" => Carbon::now(),
            "link" =>  "link jitsi" , 
            "status" => "kosong" , 
        ]);
    }
}