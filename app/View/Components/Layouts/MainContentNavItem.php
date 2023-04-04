<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class MainContentNavItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $text;
    public $wClick;

    public function __construct($text = null, $wClick = null)
    {
        $this->text = $text; 
        $this->wClick = $wClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.main-content-nav-item');
    }
}
