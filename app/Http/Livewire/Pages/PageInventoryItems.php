<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\In_out_item;
use App\Models\Purchase_detail;
use App\Models\Order;
use App\Models\Reorder;

use App\Traits\SharedVariables;
use App\Traits\WithSorting;
use App\Traits\Modal;
use App\Traits\UserActivities;

class PageInventoryItems extends Component
{
    use UserActivities;
    use WithPagination;
    use SharedVariables;
    use WithSorting;
    use Modal;

    // before deleting item
    // check if present in purchase page
    // make warning

    public
        $should_render = true,
        $selected_items = [],

        $displayed_category = 'all',
        $displayed_category_title = 'all',

        $item_in,

        $show_low_stocks = false,

        $reorder_quantity,

        $ITEM, 
        $CATEGORY, 
        // $SUPPLIER,

        $item = ['id' => ''];

        // $confirm = [
        //     'subject' => null,
        //     // 'item' => false,
        //     // 'items' => false,
        //     'in_item' => false
        // ];

    protected $listeners = [
        'refreshInventoryIndex' => '$refresh',
        'displayed_category' => ['except' => 'all', 'as' => 'category'],
        'show_low_stocks' => ['except' => false],
        'deleted_multiple'
    ];


    public function mount()
    {
        $this->orderBy = 'name';
        $this->ITEM = new Item;
        $this->CATEGORY = new Category;

        $this->count_all_items = Item::select('id')->count();
    }

    public function render()
    {
        $category = new Category;
        $items = Item::with([
            'supplier' => function($query) { $query->select('name','branch'); }, 
            'reorder' => function($query) { $query->select('item_id','quantity','status'); },
            'category', 
        ]);

        if ($this->show_low_stocks) 
            $items->whereColumn('quantity', '<=', 'buffer');

        if ($this->displayed_category != 'all')
            $items->where('category_id', $this->displayed_category);

        if (!empty($this->search)) {
            $search = "%$this->search%";
            $items->where('name', 'like', $search)
                ->orWhere('size', 'like', $search)
                ->orWhere('price', 'like', $search);
        }

        return view('livewire.pages.page-inventory-items', [
            'items' => $items->orderBy($this->orderBy, $this->sortDirection)->simplePaginate($this->paginate),
            'categories' => $category->all(['id','title']),
        ]);
    }


    // public function delete($id = null, $subject = null)
    // {
    //     if (is_null($id)) {
    //         $this->confirm['items'] = true;
    //         $this->confirmation('show', 'Are you sure?', 'You really want to delete selected item(s)?');
    //     } else {
    //         $this->item['id'] = $id;
    //         $this->confirm['item'] = true;
    //         $this->confirm['subject'] = $subject;
    //         $this->confirmation('show', 'Are you sure?', 'You really want to delete "' . $this->confirm['subject'] . '"?');
    //     }
    // }

    // public function deleted()
    // {
    //     try {
    //         $item = Item::destroy($this->item['id']);
    //         $this->toast('success', '"' . $this->confirm['subject'] . '" has been deleted successfully');
    //         $this->reset(['item']);
    //     } catch(\Exception $wtf) { $this->toastError(); }
    // }

    public function deleting_items()
    {
        return $this->confirmDialog('deleted_multiple', 'Are you sure you want to delete selected orders?');
    }

    public function deleted_multiple()
    {
        if ($this->hasPermission('item-manage')) 
            return;

        try {
            $item = Item::destroy($this->selected_items);

            $this->trait_user_activity_item_delete(count($this->selected_items));

            $this->toast('success', 'Selected items has been successfully deleted.');
            $this->reset(['item', 'selected_items']);
        } catch (\Exception $wtf) { dd($wtf); $this->toastError(); }
    }

    public function duplicate($item_id)
    {
        try {
            $item = Item::findOrFail($item_id);
            $new_item = $item->replicate();
            $new_item->save();
            
            $this->trait_user_activity_item_create();

            $this->toast('success', 'A new copy has been created.');
        } catch (\Exception $wtf) { $this->toastError(); }
    }


    // public function confirm_in_item($item_id, $item_name) {
    //     try {
    //         if (!is_null($item_id)) {
    //             $this->validate(['item_in' => 'required|min:1|integer']);
    //             $this->item['id'] = $item_id;
    //             $this->confirm['subject'] = $item_name;
    //             $this->confirm['in_item'] = true;
    //             $this->confirmation('show', 'Add New Stock', "\"{$this->item_in}\" stock(s) will be added to \"{$item_name}\", are you sure?");
    //         }
    //     } catch (\Exception $wtf) { $this->item_in = ''; }
    // }

    public function confirm_in_item($item_name)
    {
        return "onclick=\"return confirm('Add New Stock stock(s) to \'{$item_name}\'?')\"";
    }

    public function in_item($item_id, $item_name)
    {
        if ($this->hasPermission('item-quantity-edit'))
            return; 

        try {
            $increment_item = Item::findOrFail($item_id, ['id', 'quantity', 'in_date']);
            $increment_item->in_date = now();
            $increment_item->quantity = $increment_item->quantity + $this->item_in;
            $increment_item->save();

            $this->trait_user_activity_in_item();

            $in_item = Purchase_detail::create([
                'item_id' => $item_id,
                'quantity' => $this->item_in,
                'action' => true]);
                
            !$in_item ?: $this->toast('success', "\"{$this->item_in}\" new stock(s) added to \"{$item_name}\"");

            $this->reset(['item_in', 'item']);
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function reorder($item_id, $item_name)
    {
        if ($this->hasPermission('reorder-manage'))
            return;

        $this->validate(['reorder_quantity' => 'required|min:1|integer']);

        try {
            $reorder = Reorder::updateOrCreate([
                'item_id' => $item_id,
                'status' => 1
            ], [
                'item_id' => $item_id,
                'status' => 1,
                'quantity' => $this->reorder_quantity
            ]);

            // dd($reorder->quantity);

            $this->trait_user_activity_item_reorder();
    
            $this->reset(['reorder_quantity']);
            $this->toast('success', "\"{$item_name}\" has been added to Re-order page.");

        } catch (\Exception $wtf) {  dd($wtf); $this->toastError(); }
    }

    // public function confirm()
    // {
    //     $this->confirmation('close');
        
        // ! $this->confirm['item'] 
        //     ?: $this->deleted();
        // ! $this->confirm['items'] 
        //     ?: $this->deleted_multiple();
    //     ! $this->confirm['in_item']
    //         ?: $this->in_item();
            
    //     $this->reset(['confirm']);
    // }

    public function make_order()
    {
        foreach($this->selected_items as $item) 
            Order::create(['item_id' => $item]);
        
        $this->reset(['selected_items']);
    }

    public function displayed_category($id, $title = null)
    {
        $this->displayed_category = $id;
        $this->displayed_category_title = $title;
    }

    public function has_reorder($item_id)
    {
        $reorder = Reorder::where('item_id', $item_id)
            ->where('status', '!=', 3)
            ->first();

        if ($reorder) 
            return $reorder->quantity;

        return null;

        // if (count($item_id) == 0)
        //     return null;
        
        // $item_id->where('status','!=',3);
        // ->first(['item_id', 'quantity', 'status']);

        // // dd($item_id);

        // if ($item_id) 
        //     return $item_id->quantity;
    
    }

    public function display_price_in_table($price)
    {
        return $price == 0 ? 0 : number_format($price, 2);
    }

    // public function displayed_category_title($title, $count) {
    //     if ($count == 0) 
    //         return $title;
    //     else 
    //         return $title . ' | ' . $count;
    // }

    // public function count_item($category_id)
    // {
    //     $items = new Item;

    //     if ($this->show_low_stocks) {
    //         $items->whereColumn('quantity', '<', 'buffer');
    //     }

    //     if ($category_id == 'all') {
    //         return $items->count();
    //     } else {
    //         return $items->where('category_id', $category_id)->count();
    //     }


    // }
}
