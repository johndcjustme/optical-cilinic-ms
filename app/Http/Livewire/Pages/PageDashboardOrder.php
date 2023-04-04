<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\Order_item;

use App\Traits\Categories;

class PageDashboardOrder extends Component
{
    use Categories;

    public function render()
    {
        return view('livewire.pages.page-dashboard-order');
    }

    public function count_order_by_status($status_value)
    {
        return Order_item::where('status', $status_value)->count();
    }
}
