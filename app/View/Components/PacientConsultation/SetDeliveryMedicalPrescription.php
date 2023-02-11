<?php

namespace App\View\Components\PacientConsultation;

use Illuminate\View\Component;

class SetDeliveryMedicalPrescription extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public function __construct($id = "")
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pacient-consultation.set-delivery-medical-prescription');
    }
}
