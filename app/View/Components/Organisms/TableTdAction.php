<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class TableTdAction extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $edit, $delete, $more;

    public function __construct($edit = null, $delete = null, $more = null)
    {
        $this->edit = $edit;
        $this->delete = $delete;
        $this->more = $more;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.table-td-action');
    }
}
