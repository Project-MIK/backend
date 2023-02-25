<?php

namespace Database\Seeders;

use App\Models\RecordCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecordCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RecordCategory::create([
            "category_name" => "kepala"
        ]);
    }
}
