<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\Patient;
use Illuminate\Support\Str;

class PagePatientExam extends Component
{

    public $patient_id = null;

    public $show_history = false;
    
    public function render()
    {
        return view('livewire.pages.page-patient-exam', [
            'patient' => Patient::findOrFail($this->patient_id)
        ]);
    }
}


