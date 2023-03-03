<?php

namespace Database\Seeders;

use App\Models\Polyclinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolyclinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Polyclinic::factory(4)->create();
    }
}
