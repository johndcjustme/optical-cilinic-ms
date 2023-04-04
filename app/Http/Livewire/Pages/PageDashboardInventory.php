<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use App\Models\Item;
use App\Models\Category;

class PageDashboardInventory extends Component
{

    public function render()
    {
        $items = new Item();
        $running_out_items = $items->whereColumn('quantity', '<=', 'buffer')->get();

        $pieChartModel = (new PieChartModel());
        foreach(Category::all('id','title','hex') as $category) {
            $pieChartModel->addSlice(
                $category->title, 
                $items->select('category_id')->where('category_id', $category->id)->count(), 
                $category->hex
            );
        }

        return view('livewire.pages.page-dashboard-inventory',[
            'pieChartModel' => $pieChartModel,
            'all_items' => $items->select('id')->count(),
            'running_out_items' => $running_out_items,
            'count_running_out_items' => count($running_out_items)
        ]);
    }
}
