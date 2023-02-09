<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PattientSeeder::class);

        $this->call([
            AdminSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();

        $this->call([RegistrationOfficersSeeder::class]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
