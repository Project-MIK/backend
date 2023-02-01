<?php

namespace App\View\Components;

use Illuminate\View\Component;
use PhpParser\Node\Expr\Cast\Bool_;

class AppPacient extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public String $title;
    public $styles = null;
    public $scripts = null;
    public function __construct(String $title = "Telemedicine")
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.user.app');
    }
}
