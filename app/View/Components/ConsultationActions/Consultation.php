<?php

namespace App\View\Components\ConsultationActions;

use Illuminate\View\Component;

class Consultation extends Component
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
        // show complaint not equlas consultation-complete && valid status
        $complaints = [
            [
                "id" => "KL6584690",
                "description" => "Consectetur veniam excepteur est ea consequat adipisicing sunt mollit. Mollit in quis ipsum fugiat officia ea est nostrud id cupidatat voluptate adipisicing. Est veniam ullamco velit consequat cupidatat ea ad tempor sunt et do qui pariatur proident.",
                "schedule" => "1 / Januari / 2023",
                "start_consultation" => 1685571753,
                "end_consultation" => 1685572753,
                "status" => "confirmed-consultation-payment", // waiting-consultation-payment, confirmed-consultation-payment , waiting-medical-prescription-payment , confirmed-medical-prescription-payment, consultation-complete
                "valid_status" => 1685571753
            ]
        ];
        return view('components.consultation-actions.consultation', compact("complaints"));
    }
}