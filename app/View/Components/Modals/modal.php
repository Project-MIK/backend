<?php

namespace App\View\Components\modals;

use Illuminate\View\Component;

class modal extends Component
{
    public $idModal,$modalSize,$modalBg,$footer,$header;
    
    public function __construct($idModal,$modalSize = "",$modalBg="",$footer="",$header="")
    {
        $this->idModal = $idModal;
        $this->modalSize = $modalSize;
        $this->modalBg=$modalBg;
        $this->footer=$footer;
        $this->header=$header;
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
