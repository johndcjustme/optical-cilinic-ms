<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Refraction;

class PagePatientHistory extends Component
{
    public $patient_id;

    public function render()
    {
        return view('livewire.pages.page-patient-history', [
            'exams' => Refraction::where('patient_id', $this->patient_id)->orderByDesc('created_at')->get()
        ]);
    }
}
