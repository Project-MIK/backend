<?php

namespace App\View\Components\PacientConsultation;

use App\Http\Controllers\PaymentMethodController;
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
    )
    {
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
        $controller = new PaymentMethodController();
        $res = $controller->index();
        foreach ($res as $key => $value) {
            # code...
            $res[$key]['image'] = strtolower($value['id']) . '-' . 'logo' . '.png';
        }
        $this->banks = $res;
        return view('components.pacient-consultation.status-payment-consultation');
    }
}