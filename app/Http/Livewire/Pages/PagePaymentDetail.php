<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

use App\Models\Patient;
use App\Models\Purchase;
use App\Models\Payment;

use App\Traits\Modal;
use App\Traits\Categories;

class PagePaymentDetail extends Component
{
    use Modal;
    use Categories;

    public 
        $patient_id,
        $payment = [
            'amount' => '', 
            'date' => '',
            'mode' => '',
        ];

    protected $listeners = [
        'delete_payment',
        'add_payment'
    ];

    public function mount()
    {
        $this->payment['date'] = date('Y-m-d');
    }
    
    public function render()
    {
        return view('livewire.pages.page-payment-detail', 
        [
            'patient' => Patient::findOrFail($this->patient_id),
            'purchases' => Purchase::where('patient_id', $this->patient_id)->latest()->get() ?? [],
            'payment_details' => [],
        ]); 
    }

    private function payment_added($purchase_id, $is_paid = false)
    {
        $deposit = DB::raw("deposit + {$this->payment['amount']}");

        if ($is_paid) 
            $deposit = null;

        try {
            Purchase::findOrFail($purchase_id)->update(['deposit' => $deposit]);
            Payment::create([
                'purchase_id' => $purchase_id,
                'amount' => $this->payment['amount'],
                'payment_mode' => $this->payment['mode'],
                'created_at' => $this->payment['date']
            ]);
            $this->payment['amount'] = '';
            $this->toast('success', 'Payment has been successfully added.');
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function confirm_paid($purchase_id, $balance)
    {
        return "onclick=\"if (confirm('Please confirm to continue.')) Livewire.emit('add_payment', {$purchase_id}, {$balance}, true);\"";
    }

    public function add_payment($purchase_id, $balance, $is_paid = false)
    {        
        $this->validate([
            'payment.date' => 'required'
        ]);

        if ($this->hasPermission('payment-manage')) 
            return;
        
        if ($is_paid) {
            $this->payment['amount'] = $balance;
            return $this->payment_added($purchase_id, $is_paid);
        } 

        if ($this->payment['amount'] == 0) {
            return $this->toastWarning('Invalid Amount');
        } elseif ($this->payment['amount'] > $balance) {
            return $this->toastWarning('Invalid Amount.');
        } elseif ($this->payment['amount'] < $balance) {
            return $this->payment_added($purchase_id);
        } elseif ($this->payment['amount'] == $balance) {
            $is_paid = true;
            return $this->payment_added($purchase_id, $is_paid);
        }
    }

    public function deleting_payment($payment_id, $purchase_id, $amount, $total) 
    {
        return "onclick=\"if (confirm('Delete?')) Livewire.emit('delete_payment', $payment_id, $purchase_id, $amount, $total);\"";
    }

    public function delete_payment($payment_id, $purchase_id, $amount, $total)
    {
        if ($this->hasPermission('payment-manage')) 
            return;

        $deposit = DB::raw("deposit - {$amount}");

        try {
            $purchase = Purchase::findOrFail($purchase_id, ['id','deposit']);

            if (is_null($purchase->deposit))
                $deposit = $total - $amount;
            
            $purchase->update(['deposit' => $deposit]);
            Payment::destroy($payment_id);

            $this->toast('success', 'Payment has been removed.');
        } catch (\Exception $wtf) { $this->toastError(); }
    }
}
