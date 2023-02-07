<?php

namespace App\View\Components\PacientConsultation;

use Illuminate\View\Component;

class StatusPaymentMedicalPrescription extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $price;
    public $status_payment;
    public $valid_status;
    public $proof_payment_medical_prescription;
    public function __construct($price = "0", $status_payment = "", $valid_status = "", $proof_payment_medical_prescription = "")
    {
        $this->price = $price;
        $this->status_payment = $status_payment;
        $this->valid_status = $valid_status;
        $this->$proof_payment_medical_prescription = $proof_payment_medical_prescription;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pacient-consultation.status-payment-medical-prescription');
    }
}
