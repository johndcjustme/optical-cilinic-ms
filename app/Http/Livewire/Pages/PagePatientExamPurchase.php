<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Item;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\Purchase_detail;

use App\Traits\Modal;
use App\Traits\Categories;

class PagePatientExamPurchase extends Component
{
    use Modal;
    use WithPagination;
    use Categories;

    protected $paginationTheme = 'bootstrap';

    public 
        $searchItem = '',
        $list_item = false,
        $btn_confirm_text = 'Save Payment',

        $id_confirm_purchase = 'id_confirm_purchase',

        // $should_render = true,

        $patient_id = '',
        $purchase_id = '',
        $refraction_id = '',

        $pageNum = 5,

        $category = 'all',

        $view_purchases = false,

        $latest_purchase_date,

        $delete_purchase_id,

        $total = 0, 
        $balance = 0,
        $discount = '',
        $deposit = '',
        $new_deposit = '',
        $payment_mode = '',
        $is_paid = false,

        $is_invalid_deposit = '',
        $btn_save_purchase_disable = '';

    
    protected $queryString = [
        'searchItem' => ['except' => ''],
        'category' => ['except' => 'all'],
        'purchase_id' => ['except' => ''],
    ];

    protected $listeners = [
        'create_purchase',
        'delete_purchase',
        'purchase_detail_remove',
        'create_purchase',
    ];


    public function mount()
    {
        $this->display_latest_purchase();
    }

    public function render()
    {       
        if (empty($this->purchase_id))
            return view('livewire.pages.page-patient-exam-purchase');

        $data = [];
        if (!empty($this->searchItem) || $this->list_item) {
            $list_items = Item::where(function (Builder $query) {
                    return $query->where('name', 'like', "%$this->searchItem%")->orWhere('size', 'like', "%$this->searchItem%");
                });

            $this->category == 'all' 
                ?: $list_items->where('category_id', $this->category);
    
            $data = [
                'categories' => Category::all(['id','title']),
                'items' => $list_items->simplePaginate($this->pageNum, ['id', 'name', 'description', 'quantity', 'buffer', 'size','sph','cyl','price', 'category_id']),
            ];
        } else {
            $purchase = Purchase::findOrFail($this->purchase_id, ['id','discount','deposit','total']);
            $purchase_details = Purchase_detail::with(['item' => function($query) { $query->select(['id', 'name', 'description', 'quantity', 'buffer', 'size','sph','cyl','price', 'category_id']); }])
                ->where('purchase_id', $this->purchase_id)
                ->where('action', false)
                ->get();

            $this->payment_mode = $purchase->payments()->select('purchase_id','payment_mode')->latest('updated_at')->first()->payment_mode ?? null;
            
            $data += [
                'display_purchase_total' => $this->total = $this->total_amount_of_purchased_items($purchase_details, $purchase->discount),
                // 'display_purchase_total' => $this->total = $purchase->total - $purchase->discount,
                'display_purchase_balance' => $this->has_balance($purchase->deposit),
                'display_purchase_deposit' => $purchase->deposit,
                'display_purchase_discount' => $this->discount = $purchase->discount,
                'purchase_details' => $purchase_details,
                'btn_disable_deposit' => $this->has_deposit_or_paid($purchase->deposit),
                'is_paid' => $this->is_paid($purchase->deposit),
            ];
        }
        
        return view('livewire.pages.page-patient-exam-purchase', $data);
    }

    private function total_amount_of_purchased_items($purchase_details = [], $discount = 0)
    {
        $result = 0;
        foreach($purchase_details as $pd) 
            $result += $pd->price * $pd->quantity;
        
        return $result - $discount;
    }

    private function has_deposit_or_paid($deposit) 
    {
        return is_null($deposit) || $deposit > 0 ? 'disabled' : '';
    }

    private function has_balance($has_deposit)
    {
        if (empty($has_deposit) || $has_deposit == 0) 
            return 0;

        return $this->total - $has_deposit;
    }

    private function is_paid($has_deposit)
    {
        if (is_null($has_deposit)) {
            $this->is_paid = true;
            return true;
        }

        return false;
    }

    public function amount_to_pay($purchase_id, $discount = null)
    {
        $total = 0;

        if (empty($purchase_id))
            return $total;

        $purchase_detail = Purchase_detail::select(['id','quantity','price'])
            ->where('purchase_id', $purchase_id)
            ->where('action', false)
            ->get();
                                
        foreach ($purchase_detail as $pd) 
            $total += $pd->quantity * $pd->price; 

        return $total - $discount;
    }

    public function payment_get_deposit($purchase_id) 
    {
        return Purchase::find($purchase_id, ['id','deposit'])->deposit ?? 0;
    }

    public function updatedSearchItem()
    {
        if (!empty($this->seachItem)) 
            $this->list_item = true;
    }


    public function update_list_item()
    {
        $this->list_item
            ? $this->reset(['searchItem', 'list_item'])
            : $this->list_item = true;
    }




    // public function confirm_create_purchase()
    // {
    //     $this->reset(['confirm']);

    //     $this->confirm['create_purchase'] = true;
    //     $this->confirmationShow('New Purchase', 'Are you sure you want to create new purchase?', $this->id_confirm_purchase);
    //     $this->should_render = false;
    // }

    // public function confirm_delete_purchase($purchase_id) 
    // {
    //     $this->confirmationShow('Delete Purchase', 'Are you sure you want to delete this purchase?', $this->id_confirm_purchase);
    //     $this->confirm['delete_purchase'] = true;
    //     $this->delete_purchase_id = $purchase_id;
    //     $this->should_render = false;
    // }


    public function update_or_create_payment($total_amount, $has_deposit = 0)
    {
        if ($this->hasPermission('payment-manage')) 
            return;

        $data = ['total' => $total_amount];

        if ($this->new_deposit >= $total_amount)
            return $this->is_invalid_deposit = 'is-invalid';

        if ($this->new_deposit > 0 && (!empty($has_deposit) || $has_deposit > 0))
            return $this->toastWarning('Already has a deposit. To edit, please go to the "Payments" page instead.');

        if (($this->discount >= 0) && !empty($this->discount)) 
            $data += ['discount' => $this->discount];

        if ($this->new_deposit > 0 && $this->new_deposit < $total_amount) {
            $data += ['deposit' => DB::raw("deposit + {$this->new_deposit}")];
            $this->add_payment($this->purchase_id, $total_amount, $this->new_deposit);
        }

        if ($this->is_paid == true) {
            $data += ['deposit' => null];
            $this->add_payment($this->purchase_id, $total_amount, $total_amount);
        } elseif ($this->is_paid == false && $has_deposit == 0) {
            $data += ['deposit' => 0];
        }
                
        try {
            Purchase::findOrFail($this->purchase_id, ['id','deposit','total'])->update($data);

            $this->toast('success', 'Payment has been Saved!');
            $this->reset(['new_deposit','is_invalid_deposit']);
            $this->btn_confirm_text = 'Saved!';
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    private function add_payment($purchase_id, $total_amount, $deposit)
    {
        try {
            if (!empty($deposit) && $deposit > 0)
                Payment::create([
                    'purchase_id' => $this->purchase_id, 
                    'amount' => $deposit,
                    'payment_mode' => $this->payment_mode
                ]);
        } catch (\Exception $wtf) { $this->toastError('An error has occured while adding payment. Please try again.'); }
    }
    

    // public function update_or_create_payment($total_amount)
    // {
    //     if ($this->deposit > $total_amount) 
    //         return $this->toastWarning('Please, check your Deposit Amount.');

    //     $amount = [];
    //     $this->deposit != 0 || $this->deposit != ''
    //         ? $amount = ['amount' => $this->deposit]
    //         : $amount = ['amount' => $total_amount];

    //     try {
    //         Payment::updateOrCreate(['purchase_id' => $this->purchase_id], $amount);
    //         $this->toast('success', 'Payment has been Saved!');
    //         $this->btn_confirm_text = 'Saved!';
    //     } catch (\Exception $wtf) { $this->toastError(); }
    // }


    public function updatedCategory($value) 
    { 
        $this->category = $value;
    }

    public function creating_purchase()
    {
        return $this->confirmDialog('create_purchase', 'Create purchase without exam reference. Continue?');
    }

    public function create_purchase($refraction_id = null)
    {
        try {            
            Purchase::create([
                'patient_id' => $this->patient_id,
                'refraction_id' => $refraction_id == null ? null : $refraction_id
            ]);
            $this->reset(['is_paid']);
            $this->toast('success', 'Purchase has been created.');
            $this->mount(); 
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function deleting_purchase($purchase_id) {
        return "onclick=\"if (confirm('Are you sure you want to delete this purchase?')) Livewire.emit('delete_purchase','{$purchase_id}');\"";
    }

    public function delete_purchase($purchase_id) {
        try {
            Purchase::destroy($purchase_id);
            $this->toast('success', 'Purchase has been successfully deleted.');                
            $this->mount();
        } catch(\Exception $wtf) {  $this->toastError(); }
    }

    public function purchase_item($item_id, $price = null, $order = false)
    {
        try {
            if (!$order) {
                $check_stocks = Item::where('id', $item_id) //check inventory stocks
                    ->where('quantity', '>', '0')
                    ->first(['id', 'quantity', 'name', 'out_date']);
    
                if (!$check_stocks)  //add item
                    return $this->toastWarning('Cannot add, selected item has \'0 stocks\' left.');

                $check_stocks->out_date = now();
                $check_stocks->quantity = $check_stocks->quantity - 1;
                $check_stocks->save();
            }

            $data = [
                'quantity' => DB::raw('quantity + 1'),
                'price' => $price,
                'action' => false,
            ];

            $default_order_status = 1;

            if ($order) {
                if ($this->hasPermission('patient-order-manage'))
                    return;
                    
                $data += ['order_status' => $default_order_status];
            }

            Purchase_detail::updateOrCreate([
                    'purchase_id' => $this->purchase_id,
                    'item_id' => $item_id,
                ], $data);

            $this->toast('success', 'Item successfully added.');
        } catch (\Exception $wtf) { $this->toastError(); }

        $this->reset(['searchItem', 'list_item']);
    }

    public function increment_item($purchase_detail_id, $is_order = null)
    {
        if (!is_null($is_order)) 
            if ($this->hasPermission('patient-order-manage'))
                return;
        
        try {
            $detail = Purchase_detail::where('id', $purchase_detail_id)
                ->where('action', false)
                ->where('quantity', '<', 25)
                ->first(['id', 'quantity','item_id']);
            
            if (!$detail) 
                return $this->toastWarning('Item has reached the maximum limit.');

            if (is_null($is_order)) {// if item is not an order
                $item = Item::where('id', $detail->item_id) // decrement inventory
                    // ->where('quantity', '>', 0)
                    ->first(['id', 'quantity']);
    
                if ($item->quantity == 0) 
                    return $this->toastWarning('Cannot add, 0 item left.');
    
                $item->decrement('quantity');
                $item->save();
            }

            $detail->increment('quantity'); 

        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function decrement_item($purchase_detail_id, $is_order = null) 
    {
        if (!is_null($is_order)) 
            if ($this->hasPermission('patient-order-manage'))
                return;

        try {
            $detail = Purchase_detail::where('id', $purchase_detail_id)
                ->where('action', false)
                ->where('quantity', '>', 1)
                ->first(['id', 'quantity', 'item_id']);
    
            if (!$detail) 
                return;

            $detail->decrement('quantity');

            if (is_null($is_order)) { //if item is not an order
                Item::select(['id', 'quantity'])    //increment inventory
                    ->where('id', $detail->item_id)
                    ->increment('quantity');
            }

        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function confirm_purchase_detail_remove($purchase_detail_id)
    {
        return "onclick=\"if (confirm('Remove item from this list?')) Livewire.emit('purchase_detail_remove','{$purchase_detail_id}');\"";
    }

    public function purchase_detail_remove($purchase_detail_id)
    {
        try {
            $purchased_item = Purchase_detail::findOrFail($purchase_detail_id, ['id','order_status','item_id','quantity']);

            if (is_null($purchased_item->order_status)) { //if null, means item is not an order
                Item::select(['id', 'quantity'])    //increment inventory
                    ->where('id', $purchased_item->item_id)
                    ->increment('quantity', $purchased_item->quantity);
            } else {
                if ($this->hasPermission('patient-order-manage'))
                    return;
            }

            $purchased_item->delete($purchased_item->id);
        } catch(\Exception $wtf) { $this->toastError(); }
    }

    public function updatedDiscount($value)
    {
        if ($this->hasPermission('payment-manage')) 
            return;

        try {
            $my_value = $value == '' ? 0 : $value;
            $purchase = Purchase::where('patient_id', $this->patient_id)->latest()->first(['id', 'discount']);
            $purchase->update(['discount' => $my_value]);
        } catch (\Exception $wtf) { $this->toastError(); }

        $this->reset(['btn_confirm_text']);
    }

    // public function updatedDeposit($value)
    // {
    
    //     if ($value < 0) 
    //         return;
    //     elseif (empty($value)) 
    //         $value = 0;

    //     try {

    //         // Payment::where('purchase_id', $this->purchase_id)
    //         //     ->oldest()->take(1, ['id','amount','purchase_id'])
    //         //     ->update(['amount' => $my_value]) ?? Payment::create(['purchase_id' => $this->purchase_id, 'amount' => $my_value]);

    //         $payment = Payment::select(['id','purchase_id','amount'])->where('purchase_id', $this->purchase_id)->oldest()->first();
    //         if ($payment) {
    //             // dd('updated');
    //             $payment->find($payment->id)->update(['amount' => $value]);
    //         } else {
    //             Payment::create(['purchase_id' => $this->purchase_id, 'amount' => $value]);
    //         }

    //     } catch (\Exception $wtf) { $this->toastError(); }

    //     $this->reset(['btn_confirm_text']);
    // }


    public function display_latest_purchase()
    {
        $purchase = Purchase::where('patient_id', $this->patient_id)->latest()->first();
        $this->refraction_id = $purchase->refraction_id ?? null;
        $this->purchase_id = $purchase->id ?? null;
        // $this->discount = $purchase->discount ?? null;
        // $this->deposit = $purchase->deposit ?? null;
        $this->latest_purchase_date = $purchase->created_at ?? null;
    }

    public function add_order()
    {

    }

    // public function confirm()
    // {
    //     $this->confirmationClose();

    //     ! $this->confirm['create_purchase']
    //         ?: $this->create_purchase();
    //     ! $this->confirm['delete_purchase']
    //         ?: $this->delete_purchase();

    //     $this->reset(['confirm']);
    // }
}
