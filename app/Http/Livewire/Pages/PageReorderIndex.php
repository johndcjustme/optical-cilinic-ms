<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\Reorder;
use App\Models\Item;

use App\Traits\SharedVariables;
use App\Traits\WithFilter;
use App\Traits\File;
use App\Traits\Modal;
use App\Traits\Categories;
use Livewire\WithPagination;
use App\Traits\UserActivities;

class PageReorderIndex extends Component
{
    use SharedVariables;
    use WithFilter;
    use WithPagination;
    use File;
    use Modal;
    use Categories;
    use UserActivities;

    protected $listeners = [
        'deleted_reorders',
        'add_to_inventory',
        'update_order_status'
    ];

    public $current_reorder_status = 1;

    public function render()
    {
        return view('livewire.pages.page-reorder-index', [
            'reorders' => Reorder::with('item')
                ->where('status', $this->current_reorder_status)
                ->simplePaginate($this->paginate),
        ]);
    }

    public function add_to_inventory($item_id, $quantity)
    {
        if ($this->hasPermission('reorder-manage'))
            return;

        try {
            $item = Item::select('id','quantity')->findOrFail($item_id);
            $item->quantity = $item->quantity + $quantity;
            $item->save();

            $this->trait_user_activity_reorder_add_to_inventory();

            if ($item) {
                $this->toast('success', "{$quantity} stock(s) has been added from the selected item.");   
                $delete_from_reorder = Reorder::select('id', 'item_id')->where('item_id', $item_id)->delete();
                if (!$delete_from_reorder) 
                    $this->toastError();
            }
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function update_order_status_confirm($status_title, $status_value)
    {
        return "onclick=\"if (confirm('Update order status to \'{$status_title}\'?')) Livewire.emit('update_order_status', '{$status_value}')\"";
    }

    public function update_order_status($status_value)
    {
        if ($this->hasPermission('reorder-manage'))
            return;

        try {
            foreach($this->selected_items as $selected) 
                Reorder::select('id','status')->where('id', $selected)->update(['status' => $status_value]);
    
            $this->trait_user_activity_reorder_status_update();

            $this->selected_items = [];
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function deleting_reorders()
    {
        return $this->confirmDialog('deleted_reorders', 'Are you sure you want to cancel selected order(s)?');
    }

    public function deleted_reorders($param = null)
    {
        if ($this->hasPermission('reorder-manage'))
            return;

        try {
            Reorder::destroy($this->selected_items);

            $this->trait_user_activity_reorder_cancel();

            $this->confirmation('close');
            $this->toast('success', $param . ' Selected order(s) has been canceled successfully.');
            $this->selected_items = [];
        } catch(\Exception $wtf) { $this->toastError(); }
    }

    public function count_reorder_status($status_title, $status_value) 
    {
        $count = Reorder::select('status')->where('status', $status_value)->count();
        if ($count == 0) 
            return $status_title;

        return "{$status_title} | {$count}";
    }
    

    public function download($filename = "Reorder Items")
    {
        date_default_timezone_set("Asia/Manila");

        $today = date('Y-m-d');

        $new_filename = "{$filename} {$today}.pdf";
        
        // return $this->savePdf($filename);
        return response()->streamDownload(function () {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->html());
            echo $pdf->stream();
        }, $new_filename);
        // return $this->downloadPDF();
    }

    public function html()
    {
        $html = "
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                table, th, td {
                    border: 1px solid darkgray;
                }
            </style>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Particulars</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>";
            
                    foreach(Reorder::all() as $order) {
                        foreach($this->selected_items as $selected) {
                            if ($selected == $order->id) {
                                $html .= "
                                    <tr>
                                        <td>{$order->item->code}</td>
                                        <td>{$order->item->name}</td>
                                        <td>{$order->item->description}</td>
                                        <td style=\"text-align:center;\">{$order->item->size}</td>
                                        <td style=\"text-align:center;\">{$order->item->unit}</td>
                                        <td style=\"text-align:center;\">{$order->quantity}</td>
                                    </tr>
                                ";
                            }
                        }
                    }
    
        $html .= "</tbody></table>";
        return $html;
    }
}
