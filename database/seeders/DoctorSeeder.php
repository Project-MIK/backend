<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::factory(4)->create();
        DB::table('doctors')->insert([
            'name' => 'Sulthon',
            'gender' => 'M',
            'address' => 'kraksaan',
            'phone' => '081212341234',
            'email' => 'sulthon@gmail.com',
            'password' => bcrypt('rahasia'),
            'polyclinic_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
