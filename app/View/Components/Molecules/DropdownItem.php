<?php

namespace App\View\Components\Molecules;

use Illuminate\View\Component;

class DropdownItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $text;
    public $id;
    public $wClick;
    public $icon;

    public function __construct($text = null, $id = null, $wClick = null, $icon = null)
    {
        $this->text = $text;
        $this->id = $id;
        $this->wClick = $wClick;        
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.dropdown-item');
    }
}
