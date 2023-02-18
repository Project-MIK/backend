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
    public $id;
    public $price;
    public $status;
    public $banks;
    public $valid_status;
    public $proof_payment;
    public function __construct(
        $id = "",
        $price = "",
        $status = "",
        $validStatus = "",
        $proofPayment = ""
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->status = $status;
        $this->valid_status = $validStatus;
        $this->proof_payment = $proofPayment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->banks = [
            [
                "id" => "BCA",
                "name" => "BCA ( Bank Central Asia )",
                "image" => "bca-logo.png",
                "no_card" => "623724239",
                "name_card" => "RUMAH SAKIT CITRA HUSADA JEMBER"
            ],
            [
                "id" => "BRI",
                "name" => "BRI ( Bank Rakyat Indonesia )",
                "image" => "bri-logo.png",
                "no_card" => "689564234",
                "name_card" => "RUMAH SAKIT CITRA HUSADA JEMBER"
            ]
        ];
        return view('components.pacient-consultation.status-payment-medical-prescription');
    }
}
