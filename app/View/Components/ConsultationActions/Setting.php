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
        $pacient = [
            "id" => $user->id,
            "citizen" => $user->citizen,
            "nik" => $user->nik,
            "no_paspor" => $user->no_paspor,
            "fullname" => $user->name,
            "place_birth" => $user->place_birth,
            "date_birth" => $user->date_birth,
            "gender" => $user->gender,
            "blood_group" => $user->blood_group,
            "profession" => $user->profession,
            "addreass" => $user->address,
            "number_phone" => $user->phone_number,
            "email" => $user->email,
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
