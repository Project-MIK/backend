<?php

namespace App\View\Components\PacientConsultation;

use Illuminate\View\Component;

class ConfirmedConsultationAndConfirmedMedicalPrescription extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $price_consultation;
    public $status_payment_consultation;
    public $proof_payment_consultation;

    public $price_medical_prescription;
    public $status_payment_medical_prescription;
    public $proof_payment_medical_prescription;

    public $pickup_medical_prescription;
    public $pickup_medical_status;
    public $pickup_medical_description;
    public $pickup_medical_no_telp_pacient;
    public $pickup_medical_addreass_pacient;
    public $pickup_by;
    public $pickup_datetime;
    public function __construct(
        $id = "",
        $price_consultation = null,
        $status_payment_consultation = null,
        $proof_payment_consultation = null,

        $price_medical_prescription = null,
        $status_payment_medical_prescription = null,
        $proof_payment_medical_prescription = null,

        $pickup_medical_prescription = null,
        $pickup_medical_status = null,
        $pickup_medical_description = null,
        $pickup_medical_no_telp_pacient = null,
        $pickup_medical_addreass_pacient = null,
        $pickup_by = null,
        $pickup_datetime = null
    ) {
        $this->id = $id;
        $this->price_consultation = $price_consultation;
        $this->proof_payment_consultation = $proof_payment_consultation;
        $this->price_medical_prescription = $price_medical_prescription;

        $this->status_payment_consultation = $status_payment_consultation;
        $this->status_payment_medical_prescription = $status_payment_medical_prescription;
        $this->proof_payment_medical_prescription = $proof_payment_medical_prescription;

        $this->pickup_medical_prescription = $pickup_medical_prescription;
        $this->pickup_medical_status = $pickup_medical_status;
        $this->pickup_medical_description = $pickup_medical_description;
        $this->pickup_medical_no_telp_pacient = $pickup_medical_no_telp_pacient;
        $this->pickup_medical_addreass_pacient = $pickup_medical_addreass_pacient;
        $this->pickup_by = $pickup_by;
        $this->pickup_datetime = $pickup_datetime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pacient-consultation.confirmed-consultation-and-confirmed-medical-prescription');
    }
}
