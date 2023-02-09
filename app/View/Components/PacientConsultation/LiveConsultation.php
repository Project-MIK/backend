<?php

namespace App\View\Components\PacientConsultation;

use Illuminate\View\Component;

class LiveConsultation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $name_pacient;
    public $doctor;
    public $polyclinic;
    public $end_consultation;
    public function __construct(
        $id = null,
        $name_pacient = null,
        $doctor = null,
        $polyclinic = null,
        $end_consultation = null
    ) {
        $this->id = $id;
        $this->name_pacient = $name_pacient;
        $this->doctor = $doctor;
        $this->polyclinic = $polyclinic;
        $this->end_consultation = $end_consultation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pacient-consultation.live-consultation');
    }
}
