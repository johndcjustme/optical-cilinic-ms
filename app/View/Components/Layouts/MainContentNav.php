<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class MainContentNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $pageTitle;

    public function __construct($pageTitle = null)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.main-content-nav');
    }
}
