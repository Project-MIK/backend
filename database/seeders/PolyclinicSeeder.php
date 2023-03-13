<?php

namespace Database\Seeders;

use App\Models\Polyclinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolyclinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('polyclinics')->insert([
            'name' => "POLIKLINIK OBGYN (OBSTETRI & GINEKOLOGI)",
            'record_category_id' => fake()->numberBetween(1, 3)
        ]);

        DB::table('polyclinics')->insert([
            'name' => "POLIKLINIK ANAK DAN TUMBUH KEMBANG",
            'record_category_id' => fake()->numberBetween(1, 3)
        ]);

        DB::table('polyclinics')->insert([
            'name' => "POLIKLINIK PENYAKIT DALAM (INTERNA)",
            'record_category_id' => fake()->numberBetween(1, 3)
        ]);

        DB::table('polyclinics')->insert([
            'name' => "POLIKLINIK BEDAH UMUM",
            'record_category_id' => fake()->numberBetween(1, 3)
        ]);

        DB::table('polyclinics')->insert([
            'name' => "POLIKLINIK BEDAH ONKOLOGI",
            'record_category_id' => fake()->numberBetween(1, 3)
        ]);

        // Polyclinic::factory(4)->create();
    }
}
