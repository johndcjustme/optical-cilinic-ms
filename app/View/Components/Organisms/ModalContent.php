<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class ModalContent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wSubmit, $modalTitle;

    public function __construct($wSubmit = null, $modalTitle = null)
    {
        $this->wSubmit = $wSubmit;
        $this->modalTitle = $modalTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.modal-content');
    }
}
