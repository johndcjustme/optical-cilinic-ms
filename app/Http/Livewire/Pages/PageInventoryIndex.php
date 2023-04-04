<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageInventoryIndex extends Component
{
    public $currentPage;
    protected $queryString = [
        'currentPage' => ['as' => 'show'],
    ];

    public function render()
    {        
        return view('livewire.pages.page-inventory-index');
    }
}
