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
      
        $this->call(RecordCategorySeeder::class);
        $this->call([RegistrationOfficersSeeder::class , PolyclinicSeeder::class , DoctorSeeder::class , SchedulesSeeder::class , ScheduleDetailSeeder::class]);
            
        $this->call([
            PaymentMethodSeeder::class,
            AdminSeeder::class , MedicinesSeeder::class , MedicalRecordsSeeder::class , RecordSeeder::class 
        ]);
        $this->call(PattientSeeder::class);

        // \App\Models\User::factory(10)->create();

      
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
