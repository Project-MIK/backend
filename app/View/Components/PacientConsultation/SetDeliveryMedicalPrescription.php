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
    public $pickup_medical_prescription;
    public $pickup_medical_status;
    public $pickup_medical_description;
    public function __construct($id = "", $pickup_medical_prescription = null, $pickup_medical_status = null, $pickup_medical_description = null)
    {
        $this->id = $id;
        $this->pickup_medical_prescription = $pickup_medical_prescription;
        $this->pickup_medical_status = $pickup_medical_status;
        $this->pickup_medical_description = $pickup_medical_description;
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
