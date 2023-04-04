<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\Refraction;
use App\Models\Item;

class PrintExam extends Component
{
    public $examId;
    public $deposit = 0;
    public $total = 0;
    public $frames;
    public $frame_sizes;
    public $lenses;
    public $lens_quantity;
    public $print_order = false;

    public function mount() 
    {
        $this->frames = collect([]);
        $this->frame_sizes = collect([]);
        $this->lenses = collect([]);
        $this->lens_quantity = collect([]);
    }

    public function render(PagePatientExamPurchase $purchase)
    {
        $rf = Refraction::with([
                    'patient' => function ($query) { $query->select(['id','name','age','occupation','mobile_1','address']); },
                ])->findOrFail($this->examId);

        $purchase = $rf->purchase->first();

        $this->display_purchased_items($purchase);

        if ($purchase) {
            $this->total = $purchase->total;
            $this->deposit = $purchase->deposit;
        }

        return view('livewire.pages.print-exam',
            [   
                'rf' => $rf,
                'total' => $this->total,
                'balance' => $this->balance($this->total, $this->deposit),
                'deposit' => $this->deposit
            ])
            ->extends('layouts.print-exam');
    }

    private function balance($total, $deposit)
    {
        if (is_null($deposit))
            return 0;
        
        return $total - $deposit;
    }

    public function has_balance($balance) {
        if ($balance == 0)
            return 'PAID';
    
        return number_format($balance, 2);
    }

    public function display_purchased_items($purchase)
    {
        $category_ids = [1, 2];

        if (is_null($purchase)) 
            return;

        foreach ($category_ids as $category) {
            foreach ($purchase->purchase_details as $details) { 
                foreach ($details->item()->select(['id','name','category_id','size','quantity'])->where('category_id', $category)->get() as $item) {
                    if ($category == 1) {
                        $this->lenses->push($item->name);
                        $this->lens_quantity->push($details->quantity);
                    }
                    if ($category == 2) {
                        $this->frames->push($item->name);
                        $this->frame_sizes->push($item->size);
                    }
                }
            }
        }
    }
}



