<?php

namespace App\View\Components\PacientConsultation;

use Illuminate\View\Component;

class ConfirmedConsultationPayment extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $price;
    public $status_payment;
    public $consultation_proof_payment;
    public function __construct($price = "0", $status_payment = "", $consultation_proof_payment = "")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pacient-consultation.confirmed-consultation-payment');
    }
}
