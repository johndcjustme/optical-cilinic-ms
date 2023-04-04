<?php

namespace App\View\Components\Atoms;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $text;
    public $wClick;
    public $icon;

    public function __construct($text = null, $wClick = null, $icon = null)
    {
        $this->text = $text;
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
        return view('components.atoms.button');
    }
}
