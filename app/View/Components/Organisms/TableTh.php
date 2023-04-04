<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class TableTh extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $text;
    public $sortColumn;
    public $direction;
    public $desc;
    public $subDesc;
    public $descTitle;
    
    public function __construct($text = null, $sortColumn = null, $direction = null, $desc = null, $subDesc = null, $descTitle = null)
    {
        $this->text = $text;
        $this->sortColumn = $sortColumn;
        $this->direction = $direction;
        $this->desc = $desc;
        $this->subDesc = $subDesc;
        $this->descTitle = $descTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.table-th');
    }
}
