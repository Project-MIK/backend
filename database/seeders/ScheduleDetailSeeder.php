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
            "time_start" => Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->format('hh:mm'),
            "time_end" => Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->format('hh:mm'),
            "link" =>  "link jitsi" , 
            "status" => "terisi" , 
        ]);
    }
}