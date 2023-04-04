<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class TableTdCheckbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wModel, $value;

    public function __construct($wModel = null, $value = null)
    {
        $this->wModel = $wModel;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.table-td-checkbox');
    }
}
