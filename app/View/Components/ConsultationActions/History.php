<?php

namespace App\View\Components\ConsultationActions;

use App\Http\Controllers\PattientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class History extends Component
{
    private PattientController $controller;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->controller = new PattientController();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // show complaint consultation-complete, expired && not valid status
        // $history_complaints = [
        //     [
        //         "id" => "KL6584690",
        //         "description" => "Consectetur veniam excepteur est ea consequat adipisicing sunt mollit. Mollit in quis ipsum fugiat officia ea est nostrud id cupidatat voluptate adipisicing. Est veniam ullamco velit consequat cupidatat ea ad tempor sunt et do qui pariatur proident.",
        //         "schedule" => 1685571753,
        //         "start_consultation" => 1685571753,
        //         "end_consultation" => 1685572753,
        //         "status" => "waiting-consultation-payment",
        //         "status_payment_consultation" => "TERKONFIRMASI",
        //         "status_payment_medical_prescription" => "DIBATALKAN",
        //         "valid_status" => 1676441478
        //     ]
        // ];
        $history_complaints = $this->controller->showRecordHistory(Auth::guard('pattient')->user()->medical_record_id);

        return view('components.consultation-actions.history', compact("history_complaints"));
    }
}
