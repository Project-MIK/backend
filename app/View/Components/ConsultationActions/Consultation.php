<?php

namespace App\View\Components\ConsultationActions;

use App\Http\Controllers\PattientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Consultation extends Component
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
        $complaint = $this->controller->showRecordDashboard(Auth::guard('pattient')->user()->medical_record_id);
       
        return view('components.consultation-actions.consultation', compact("complaint"));
    }
}
