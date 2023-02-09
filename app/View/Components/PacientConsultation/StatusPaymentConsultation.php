<?php

namespace App\View\Components\PacientConsultation;

use Illuminate\View\Component;

class StatusPaymentConsultation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $price;
    public $status_payment;
    public $banks;
    public $valid_status;
    public $proof_payment_consultation;
    public function __construct(
        $id = null,
        $price = "0",
        $status_payment = "",
        $banks = [],
        $valid_status = "",
        $proof_payment_consultation = ""
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->status_payment = $status_payment;
        $this->banks = $banks;
        $this->valid_status = $valid_status;
        $this->$proof_payment_consultation = $proof_payment_consultation;
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
        return view('components.pacient-consultation.status-payment-consultation');
    }
}
