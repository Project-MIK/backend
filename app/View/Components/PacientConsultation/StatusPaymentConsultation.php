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
    public $status;
    public $proofPayment;
    public $validStatus;
    public $banks;
    public function __construct(
        $id = null,
        $price = "",
        $status = "",
        $proofPayment = "",
        $validStatus = ""
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->status = $status;
        $this->proofPayment = $proofPayment;
        $this->validStatus = $validStatus;
        $this->banks;
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
