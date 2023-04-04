<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
// use App\Traits\SharedVariables;

class Main extends Component
{
    // use SharedVariables;

    public $page = 'dashboard';

    protected $queryString = [
        'page' => ['except' => '']
    ];

    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.pages.main')->extends('layouts.app');
    }

    public function updatedPage()
    {
        $this->emit('refreshPage');
    }

    public function is_active($active_page)
    {
        return $this->page == $active_page ? 'active' : '';
    }
}
