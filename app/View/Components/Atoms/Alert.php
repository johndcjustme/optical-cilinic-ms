<?php

namespace App\View\Components\Atoms;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $textBody, $textFooter, $icon, $dismiss;

    public function __construct($title = null, $textBody = null, $textFooter = null, $icon = null, $dismiss = null)
    {
        $this->title = $title; 
        $this->textBody = $textBody; 
        $this->textFooter = $textFooter; 
        $this->icon = $icon;
        $this->dismiss = $dismiss;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.alert');
    }
}
