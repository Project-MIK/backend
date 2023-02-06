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
    public $price;
    public $status_payment;
    public $valid_status;
    public $consultation_proof_payment;
    public function __construct($price = "0", $status_payment = "", $valid_status = "", $consultation_proof_payment = "")
    {
        $this->price = $price;
        $this->status_payment = $status_payment;
        $this->valid_status = $valid_status;
        $this->$consultation_proof_payment = $consultation_proof_payment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pacient-consultation.status-payment-consultation');
    }
}
