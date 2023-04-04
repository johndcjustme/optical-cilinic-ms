<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\Supplier;
use App\Models\Order_item;

use App\Traits\Modal;

class PagePatientOrder extends Component
{
    use Modal;


    public 
        $total = 0,
        $subtotal = 0,
        $number = 1,
        $patient_id, 
        $refraction_id,

        $make_order = false,

        $order = [
            'name',
            'description',
            'size',
            'quantity',
            'supplier',
        ];

    public 
        $order_lens = [
            'refraction_id',
            'particular',
            'quantity',
            'price',
        ],
        $order_frame = [
            'type',
            'code' => null,
            'particular' => null,
            'quantity',
            'price' => null,
            'size' => null
        ];

    protected $listeners = ['mount','delete_order'];

    public function mount($refraction_id = null) {
        $this->refraction_id = $refraction_id;
    }

    public function render(Order_item $orders)
    {
        return view('livewire.pages.page-patient-order', [
            'suppliers' => Supplier::all(['id','name','branch']),
            'lens_orders' => $orders->where('patient_id', $this->patient_id)->where('category_id', 1)->orderBy('status')->get(),
            'frame_orders' => $orders->where('patient_id', $this->patient_id)->where('category_id', 2)->orderBy('status')->get(),
        ]);
    }

    public function create_order()
    {
        if ($this->hasPermission('patient-order-manage'))
            return;

        $this->validate([
                'order.name' => 'required',
                'order.supplier' => 'required',
                'order.quantity' => 'required|integer',
            ], [
                'order.name.required' => 'Required',
                'order.supplier.required' => 'Required',
                'order.quantity.required' => 'Required',
                'order.quantity.integer' => 'Invalid input'
            ]);

        try {
            Order_item::create([
                'name' => $this->order['name'],
                'description' => $this->order['description'] ?? null,
                'size' => $this->order['size'] ?? null,
                'quantity' => $this->order['quantity'],
                'supplier_id' => $this->order['supplier'],
                'patient_id' => $this->patient_id,
                'status' => 1
            ]);
    
            $this->toast('success', 'Order has been saved.');
            $this->reset(['order']);
            $this->resetValidation();
        } catch (\Exception $wtf) { dd($wtf); $this->toastError(); }
        
    }

    public function deleting_order($order_id)
    {
        return "onclick=\"if (confirm('Are you sure you want to delete selected order?')) Livewire.emit('delete_order','{$order_id}');\"";
    }

    public function delete_order($order_id)
    {
        if ($this->hasPermission('patient-order-manage'))
            return;

        try {
            Order_item::destroy($order_id);
            $this->toast('success', 'Order Deleted.');
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function creating_lens_order()
    {
        return "onclick=\"return confirm('Confirm?')\"";
    }

    public function create_lens_order()
    {
        $this->validate([
            'order_lens.refraction_id' => 'required',
            // 'order_lens.patient_id' => 'required',
            'order_lens.particular' => 'required',
            'order_lens.quantity' => 'required',
            'order_lens.price' => 'nullable'
        ]);

        $lens_category_id = 1;

        try {
            Order_item::updateOrCreate([
                'refraction_id' => trim($this->order_lens['refraction_id']),
            ],[
                'category_id' => $lens_category_id,
                'patient_id' => $this->patient_id,
                'name' => $this->order_lens['particular'],
                'quantity' => $this->order_lens['quantity'],
                'price' => $this->order_lens['price'] ?? 0,
            ]);
            $this->reset(['order_lens']);
            $this->toast('success', 'Lens Order has been saved.');
        } catch (\Exception $wtf) { dd($wtf); $this->toastError(); }
    }

    public function creating_frame_order()
    {
        return "onclick=\"return confirm('Confirm?')\"";
    }

    public function create_frame_order()
    {
        $this->validate([
            'order_frame.quantity' => 'required'
        ]);

        $frame_category_id = 2;

        try {
            Order_item::create([
                'category_id' => $frame_category_id,
                'patient_id' => $this->patient_id,
                'code' => $this->order_frame['code'],
                'name' => $this->order_frame['particular'],
                'description' => $this->order_frame['type'],
                'quantity' => $this->order_frame['quantity'],
                'price' => $this->order_frame['price'] ?? 0,
                'size' => $this->order_frame['size'],
            ]);

            $this->reset(['order_frame']);
            $this->toast('success', 'Lens Order has been saved.');
        } catch (\Exception $wtf) { dd($wtf); $this->toastError(); }
    }
}
