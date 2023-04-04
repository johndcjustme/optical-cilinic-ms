<?php

namespace App\View\Components\Atoms;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public 
        $wModel, 
        $wModelNodefer, 
        $label, 
        $required, 
        $error, 
        $group, 
        $select, 
        $textarea, 
        $checkbox, 
        $checkboxText, 
        $checkboxValue, 
        $floating,
        $radio,
        $readonly,
        $labelClass,
        $nodefer;

    public function __construct(
        $wModel = null, 
        $wModelNodefer = null, 
        $label = null, 
        $required = null, 
        $error = null, 
        $group = null, 
        $select = null, 
        $textarea = null, 
        $checkbox = null, 
        $checkboxText = null, 
        $checkboxValue = null, 
        $floating = null,
        $radio = null,
        $readonly = null,
        $labelClass = null,
        $nodefer = null
    ) {    
        $this->wModel           = $wModel; 
        $this->wModelNodefer           = $wModelNodefer; 
        $this->label            = $label; 
        $this->required         = $required;    
        $this->error            = $error;
        $this->group            = $group;
        $this->select           = $select;
        $this->textarea         = $textarea;
        $this->checkbox         = $checkbox;
        $this->checkboxText     = $checkboxText;
        $this->checkboxValue    = $checkboxValue;
        $this->floating         = $floating;
        $this->radio            = $radio;
        $this->readonly         = $readonly;
        $this->labelClass       = $labelClass;
        $this->nodefer          = $nodefer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.input');
    }
}
