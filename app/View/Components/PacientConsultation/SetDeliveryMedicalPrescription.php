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
    public $validStatus;
    public $priceConsultation;
    public $statusConsultation;
    public $proofPaymentConsultation;
    public $priceMedical;
    public $statusMedical;
    public $proofPaymentMedical;

    public function __construct(
        $id = "",
        $validStatus = 0,

        $priceConsultation = "",
        $statusConsultation = "",
        $proofPaymentConsultation = "",

        $priceMedical = "",
        $statusMedical = "",
        $proofPaymentMedical = ""
    ) {
        $this->id = $id;
        $this->validStatus = $validStatus;

        $this->priceConsultation = $priceConsultation;
        $this->statusConsultation = $statusConsultation;
        $this->proofPaymentConsultation = $proofPaymentConsultation;

        $this->priceMedical = $priceMedical;
        $this->statusMedical = $statusMedical;
        $this->proofPaymentMedical = $proofPaymentMedical;
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
