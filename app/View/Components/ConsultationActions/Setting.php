<?php

namespace App\View\Components\ConsultationActions;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Setting extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // Split addreass to array
    public function getAddreass(String $addreass)
    {
        return explode("/", $addreass);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user = Auth::guard('pattient')->user();
        // $pacient = [
        //     "id" => "PCT4234728342",
        //     "citizen" => "indonesia",
        //     "nik" => "6386497275804764",
        //     "no_paspor" => "-",
        //     "fullname" => "Aristo Caesar Pratama",
        //     "place_birth" => "Banyuwangi",
        //     "date_birth" => "04-07-2002",
        //     "gender" => "M",
        //     "blood_group" => "O",
        //     "profession" => "Software Enginer",
        //     "addreass" => "003/005/Blokagung/Karangdoro/Tegalsari/Banyuwangi",
        //     "number_phone" => "085235119101",
        //     "email" => "aristo.belakang@gmail.com",
        //     "created_at" => now()
        // ];
        $pacient = [
            "id" => "PCT4234728342",
            "citizen" => "Warga Negara Indonesia",
            "nik" => "6386497275804764",
            "no_paspor" => "-",
            "fullname" => "Aristo Caesar Pratama",
            "place_birth" => "Banyuwangi",
            "date_birth" => "04-07-2002",
            "gender" => "M",
            "blood_group" => "O",
            "profession" => "Software Enginer",
            "addreass" => "003/005/Blokagung/Karangdoro/Tegalsari/Banyuwangi",
            "number_phone" => "085235119101",
            "email" => "aristo.belakang@gmail.com",
            "created_at" => now()
        ];
        $blood_group = [
            "A",
            "B",
            "AB",
            "O"
        ];

        return view('components.consultation-actions.setting', [
            "pacient" => $pacient,
            "addreass" => $this->getAddreass($pacient['addreass']),
            "blood_group" => $blood_group
        ]);
    }
}
