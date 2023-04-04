<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class SideNavigationItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $icon;

    public function __construct($icon = null)
    {
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.side-navigation-item');
    }
}
