<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class TableTd extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $text;
    public $textClass;

    public $icon;
    public $desc;
    public $descIcon;

    public $subDesc;

    public function __construct($text = null, $desc = null, $subDesc = null, $descIcon = null, $icon = null, $textClass = null)
    {
        $this->text = $text;
        $this->desc = $desc;
        $this->subDesc = $subDesc;
        $this->descIcon = $descIcon;
        $this->icon = $icon;
        $this->textClass = $textClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.table-td');
    }
}
