<?php
namespace App\Http\Livewire\Interfaces;

interface IPatient {
    public function delete($id = null, $subject = null);
}
