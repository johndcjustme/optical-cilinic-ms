<?php

namespace App\View\Components\Atoms;

use Illuminate\View\Component;

class Search extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wModel;
    public function __construct($wModel = null)
    {
        $this->wModel = $wModel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.search');
    }
}
