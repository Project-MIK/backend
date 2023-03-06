<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PaymentMethod::create(
            [
                'id' => 'BRI',
                'name' => 'BANK REPUBLIK INDONESIA',
                'no_rek' => "2039276351298",
                'atas_nama' => "RUMAH SAKIT HUSADA JEMBER"
            ],
            [
                'id' => 'BCI',
                'name' => 'BANK BCA',
                'no_rek' => "2039276351298",
                'atas_nama' => "RUMAH SAKIT HUSADA JEMBER"
            ]
        );
    }
}