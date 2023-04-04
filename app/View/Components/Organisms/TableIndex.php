<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class TableIndex extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $paginate;
    public $withCard;

    public function __construct($paginate = null, $withCard = null)
    {
        $this->paginate = $paginate;
        $this->withCard = $withCard;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.table-index');
    }
}
