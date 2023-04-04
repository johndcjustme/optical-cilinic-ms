<?php

namespace App\Traits;

trait WithSorting
{
    public $orderBy;
    public $sortDirection = 'asc';

    protected $queryStringWithSorting = [
        'orderBy' => ['except' => 'id'],
        'sortDirection' => ['except' => 'asc'],
    ];

    
    public function orderBy($field)
    {
        $this->sortDirection = $this->orderBy === $field
            ? $this->reverseSort()
            : 'asc';
 
        $this->orderBy = $field;
    }
 
    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

}