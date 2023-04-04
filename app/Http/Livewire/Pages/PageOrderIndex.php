<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Patient;
use App\Models\Order_item;
use App\Models\Purchase_detail;

use App\Traits\SharedVariables;
use App\Traits\WithFilter;
use App\Traits\Modal;
use App\Traits\Categories;
use App\Traits\File;

use Dompdf\Dompdf;
use PDF;

class PageOrderIndex extends Component
{
    use SharedVariables;
    use WithPagination;
    use WithFilter;
    use Modal;
    use Categories;
    use File;

    public 
        $lens_category_id = 1,
        $frame_category_id = 2;

    protected $listeners = [
        'deleted_orders','update_order_status'
    ];

    public $current_order_status = 1;


    public function mount()
    {
        $this->setDefaultFilter('this_year');
    }

    public function render()
    {
        $orders = Purchase_detail::where('order_status', '!=', null);
        $this->withFilter($orders);

        $count_orders_based_on_filter = $orders->count();

        return view('livewire.pages.page-order-index', [
            'count_order_status' => $count_orders_based_on_filter,
            'orders' => $orders
                ->where('order_status', $this->current_order_status)
                ->where('order_status','!=',null)->get()
        ]);
    }


    public function count_order_status($status_value) {
        $count_orders = Purchase_detail::select('order_status')->where('order_status', $status_value)->count();
        $result = $count_orders == 0 ? '' : " | {$count_orders}";
        return $result;
    }

    // public function order_status($status_value) 
    // {
    //     foreach($this->order_status as $status) 
    //         if ($status['value'] == $status_value) 
    //             return $status['title'];
        
    //     return;
    // }

    // public function order_status_text($status_value) 
    // {
    //     foreach($this->order_status as $status) 
    //         if ($status['value'] == $status_value) 
    //             return $status['text_color'];
        
    //     return;
    // }

    public function updating_order_status($order_status)
    {
        return "onclick=\"if (confirm('Are you sure you want to update order status of selected item(s)?')) Livewire.emit('update_order_status','{$order_status}')\"";
    }

    public function update_order_status($order_status)
    {
        if ($this->hasPermission('patient-order-manage'))
            return;

        if (count($this->selected_items) > 0) {
            try {
                foreach ($this->selected_items as $item) 
                    Purchase_detail::find($item, ['id','order_status'])->update(['order_status' => $order_status]);

                $this->selected_items = [];
            } catch(\Exception $wtf) { $this->toastError(); }
        }
    }

    public function deleting_orders()
    {
        return $this->confirmDialog('deleted_orders', 'Are you sure you want to delete selected orders?');
    }

    public function deleted_orders($param = null)
    {
        if ($this->hasPermission('patient-order-manage'))
            return;

        try {
            Purchase_detail::destroy($this->selected_items);
            $this->confirmation('close');
            $this->toast('success', $param . ' Selected orders has been deleted successfully.');
            $this->selected_items = [];
        } catch(\Exception $wtf) { $this->toastError(); }
    }

    // public function show_order_detail()
    // {
    //     $this->emit('patient_order_show_detail');
    // }



    public function download($category)
    {
        if ($category == 1)
            return $this->downloadPDF_Lens();
        if ($category == 2)
            return $this->downloadPDF_Frame();
    }


    private function frame_html()
    {
        $frame_category_id = 2;
        $orders = Purchase_detail::where('order_status', '!=', null)->get();

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
                        <th>Size</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>";

                    if (count($this->selected_items) == 0) {
                        foreach ($orders as $order) {
                            if ($order->item->category_id == $frame_category_id) {
                                $html .= "
                                    <tr>
                                        <td>{$order->item->code}</td>
                                        <td>{$order->item->name}</td>
                                        <td style=\"text-align:center;\">{$order->item->size}</td>
                                        <td style=\"text-align:center;\">{$order->quantity}</td>
                                    </tr>
                                ";
                            }
                        }
                    } else {
                        foreach($this->selected_items as $selected) {
                            foreach($orders as $order) {
                                if ($selected == $order->id) {
                                    $html .= "
                                        <tr>
                                            <td>{$order->item->code}</td>
                                            <td>{$order->item->name}</td>
                                            <td style=\"text-align:center;\">{$order->item->size}</td>
                                            <td style=\"text-align:center;\">{$order->quantity}</td>
                                        </tr>
                                    ";
                                }
                            }
                        }
                    }

        $html .= "</tbody></table>";
        return $html;
    }

    private function lens_html()
    {
        $lens_category_id = 1;
        $frame_category_id = 2;

        $frames = collect([]);
        $frame_sizes = collect([]);

        $orders = Purchase_detail::where('order_status', '!=', null)->get();

        $html = "
            <style>
                table {
                    border-collapse: collapse;  
                    width: 100%;
                }
                table, th, td {
                    border: 1px solid black;
                }
                th, td {
                    padding:0.2rem;
                }
                .container {
                    width:100%;
                }
                .table-container {
                    max-width:5in;
                    margin:1rem;
                }
            </style>
            <div class=\"container\">
        ";

        foreach ($orders as $order) {
            if (count($this->selected_items) == 0) {
                if ($order->item->category_id == $lens_category_id) {
                    //get frames also
                    foreach ($order->purchase()->get() as $purchase) {
                        foreach ($purchase->purchase_details->where('purchase_id', $purchase->id) as $detail) {
                            if ($detail->item->category_id == $frame_category_id) {
                                $frames->push($detail->item->name);
                                $frame_sizes->push($detail->item->size);            
                            }
                        }
                    }
                    $html .= $this->refraction_table($order, $frames, $frame_sizes);
                }
            } else {
                foreach($this->selected_items as $selected) {
                    if ($selected == $order->id) {
                        $html .= $this->refraction_table($order, $frames, $frame_sizes);
                    }
                }
            }
        }

        $html .= "</div>";
        return $html;
    }



    public function refraction_table($order = [], $frames, $frame_sizes) {
        return "
            <div class=\"table-container\">
                <table>
                    <tr>
                        <td colspan=\"6\"><b>Name: </b>{$order->purchase->patient->name}</td>
                        <td><b>Age: </b>{$order->purchase->patient->age}</td>
                    </tr>
                    <tr>
                        <td colspan=\"6\"><b>Occupation: </b>{$order->purchase->patient->occupation}</td>
                        <td><b>Phone: </b>{$order->purchase->patient->mobile_1}</td>
                    </tr>
                    <tr>
                        <td colspan=\"7\"><b>Address: </b>{$order->purchase->patient->address}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th colspan=\"7\" style=\"text-align:center;\">REFRACTION</th>
                    </tr>
                    <tr>
                        <th style=\"width:3rem;\">RX</th>	
                        <th>SPH</th>	
                        <th>CYL</th>	
                        <th>AXIS</th>	
                        <th>NVA</th>	
                        <th>PH</th>	
                        <th>CVA</th>
                    </tr>
                    <tr>
                        <th>OD</th>	
                        <td>{$order->purchase->refraction->OD_SPH}</td>	
                        <td>{$order->purchase->refraction->OD_CYL}</td>	
                        <td>{$order->purchase->refraction->OD_AXIS}</td>	
                        <td>{$order->purchase->refraction->OD_NVA}</td>	
                        <td>{$order->purchase->refraction->OD_PH}</td>	
                        <td>{$order->purchase->refraction->OD_CVA}</td>
                    </tr>
                    <tr>
                        <th>OS</th>	
                        <td>{$order->purchase->refraction->OS_SPH}</td>	
                        <td>{$order->purchase->refraction->OS_CYL}</td>	
                        <td>{$order->purchase->refraction->OS_AXIS}</td>	
                        <td>{$order->purchase->refraction->OS_NVA}</td>	
                        <td>{$order->purchase->refraction->OS_PH}</td>	
                        <td>{$order->purchase->refraction->OS_CVA}</td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td colspan=\"3\"><b>ADD: </b>{$order->purchase->refraction->ADD}</td>
                        <td colspan=\"4\"><b>P.D.: </b>{$order->purchase->refraction->PD}</td>
                    </tr>
                    <tr>
                        <td colspan=\"7\"><b>Frame: </b>{$frames->implode(',')}</td
                    </tr>
                    <tr>
                        <td colspan=\"7\"><b>Frame Size: </b>{$frame_sizes->implode(',')}</td
                    </tr>
                    <tr>
                        <td colspan=\"7\"><b>Lens: </b>{$order->item->name}</td>
                    </tr>
                    <tr>
                        <td colspan=\"7\"><b>Lens Qty: </b>{$order->quantity}</td
                    </tr>
                    <tr>
                        <td colspan=\"7\"><b>Remarks: </b>{$order->purchase->refraction->remarks}</td
                    </tr>
                </table>
            </div>
        ";
    }
}


