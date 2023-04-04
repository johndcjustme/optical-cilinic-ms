<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Reorder;
use App\Traits\Categories;

class PageDashboardReorders extends Component
{
    use Categories;

    public $reorder;

    public function mount(Reorder $reorder) 
    {
        $this->reorder = $reorder;
    }

    public function count_reorder_status($status_value)
    {
        return $this->reorder->select('status')->where('status', $status_value)->count();
    }

    public function render()
    {
        return view('livewire.pages.page-dashboard-reorders');
    }
}