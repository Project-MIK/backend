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
    public function __construct()
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
        return view('components.pacient-consultation.status-payment-medical-prescription');
    }
}
