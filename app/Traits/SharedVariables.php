<?php

namespace App\Traits;

trait SharedVariables
{
    public $i = 1;

    public $selected_items = [];
    
    public $paginate = 10;

    public $search;

    public $currentPage;

    protected $paginationTheme = 'bootstrap';

    protected $queryStringSharedVariables = [
        'search' => ['except' => ''],
        'currentPage' => ['except' => ''],
    ];


    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedPaginate()
    {
        $this->resetPage();
    }
}