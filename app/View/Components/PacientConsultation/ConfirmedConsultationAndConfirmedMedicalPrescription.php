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
    public $priceConsultation;
    public $statusPaymentConsultation;
    public $proofPaymentConsultation;

    public $priceMedicalPrescription;
    public $statusPaymentMedicalPrescription;
    public $proofPaymentMedicalPrescription;

    public $pickupMedicalPrescription;
    public $pickupMedicalStatus;
    public $pickupMedicalDescription;
    public $pickupMedicalPhoneNumberPacient;
    public $pickupMedicalAddreassPacient;
    public $pickupByPacient;
    public $pickupDatetime;
    public function __construct(
        $id = null,
        $priceConsultation = null,
        $statusPaymentConsultation = null,
        $proofPaymentConsultation = null,

        $priceMedicalPrescription = null,
        $statusPaymentMedicalPrescription = null,
        $proofPaymentMedicalPrescription = null,

        $pickupMedicalPrescription = null,
        $pickupMedicalStatus = null,
        $pickupMedicalDescription = null,
        $pickupMedicalPhoneNumberPacient = null,
        $pickupMedicalAddreassPacient = null,
        $pickupByPacient = null,
        $pickupDatetime = null
    ) {
        $this->id = $id;
        $this->priceConsultation = $priceConsultation;
        $this->statusPaymentConsultation = $statusPaymentConsultation;
        $this->proofPaymentConsultation = $proofPaymentConsultation;

        $this->priceMedicalPrescription = $priceMedicalPrescription;
        $this->statusPaymentMedicalPrescription = $statusPaymentMedicalPrescription;
        $this->proofPaymentMedicalPrescription = $proofPaymentMedicalPrescription;

        $this->pickupMedicalPrescription = $pickupMedicalPrescription;
        $this->pickupMedicalStatus = $pickupMedicalStatus;
        $this->pickupMedicalDescription = $pickupMedicalDescription;
        $this->pickupMedicalPhoneNumberPacient = $pickupMedicalPhoneNumberPacient;
        $this->pickupMedicalAddreassPacient = $pickupMedicalAddreassPacient;
        $this->pickupByPacient = $pickupByPacient;
        $this->pickupDatetime = $pickupDatetime;
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
