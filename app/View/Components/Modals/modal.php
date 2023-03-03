<?php

namespace App\View\Components\modals;

use Illuminate\View\Component;

class modal extends Component
{
    public $idModal,$modalSize,$modalBg;
    
    public function __construct($idModal,$modalSize = "",$modalBg="")
    {
        $this->idModal = $idModal;
        $this->modalSize = $modalSize;
        $this->modalBg=$modalBg;
    }

    

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.modal');
    }
}
