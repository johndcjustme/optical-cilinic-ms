<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

use App\Models\In_out_item as Inout;
use App\Models\Item;
use App\Models\Purchase_detail;

use App\Traits\SharedVariables;
use App\Traits\WithFilter;
use App\Traits\WithSorting;



class PageInventoryInOut extends Component
{
    use SharedVariables;
    use WithSorting;    
    use WithPagination;
    use WithFilter;

    // in/out should automatically be filtered by today's date by clicking the page link, or any selected date by user's choice

    public $view_in_out_details_id;
    public $view_in_out_details_name;
    public $view_in_out_details_size;

    public $IN_OUT;

    public function mount()
    {
        $this->orderBy = 'name';
        $this->IN_OUT = new Inout;
        $this->ITEM = new Item;

        // available filters: today, yesterday, this_week, last_week, this_month, last_month, this_year, last_year.
        $this->setDefaultFilter('this_month');
    }


    public function render()
    {
        $items = $this->ITEM
            ->has('in_out')
            ->with('category')
            ->withCount([
                'in_out as in_count' => function (Builder $query) { $query->where('action', true); }, 
                'in_out as out_count' => function (Builder $query) { $query->where('action', false); }
            ])
            ->where('name', 'like', '%'. $this->search .'%');

        $this->withFilter($items, 'in_date');

        $data = [
            // 'in_out_items' => $this->IN_OUT::all(),
            'items' => $items->orderBy($this->orderBy, $this->sortDirection)->simplePaginate($this->paginate),
            'in_out_items' => Purchase_detail::where('item_id', $this->view_in_out_details_id)->get() ?? [],
        ];

        return view('livewire.pages.page-inventory-in-out', $data);
    }

    public function in($item_id)
    {
        return Purchase_detail::where('item_id', $item_id)
            ->where('action', true)
            ->sum('quantity');
    }

    public function out($item_id)
    {
        return Purchase_detail::where('item_id', $item_id)
            ->where('action', false)
            ->sum('quantity');
    }


    public function view_in_out_details($item_id, $item_name, $item_size = null)
    {
        $this->view_in_out_details_id = $item_id;
        $this->view_in_out_details_name = $item_name;
        $this->view_in_out_details_size = $item_size;
        $this->dispatchBrowserEvent('view-in-out-details');
    }
}




    


