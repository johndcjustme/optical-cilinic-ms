<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

use App\Traits\Modal;
use App\Traits\UserActivities;

class PageSupplierIndexModal extends Component
{
    use Modal;
    use UserActivities;

    public $su = [
        'id',
        'code',
        'name',
        'mobile_1',
        'email',
        'branch',
        'address',
        'account_name',
        'account_number'
    ];

    protected $listeners = ['modal_show', 'edit_supplier'];

    public function render()
    {
        return view('livewire.pages.page-supplier-index-modal');
    }

    public function set_supplier()
    {
        return [
            'code'              => $this->su['code'],
            'name'              => $this->su['name'],
            'mobile_1'          => $this->su['mobile_1'],
            'email'             => $this->su['email'],
            'branch'            => $this->su['branch'],
            'address'           => $this->su['address'],
            'account_name'      => $this->su['account_name'] ?? NULL,
            'account_number'    => $this->su['account_number'] ?? NULl,
        ];
    }
    
    public function validate_first()
    {
        $this->validate([
            'su.name' => 'required|max:100|min:2',
            'su.mobile_1' => 'required',
            'su.email' => 'required|email',
            'su.branch' => 'required|max:255|min:2',
            'su.address' => 'required|max:255|min:2',

            'su.account_name' => 'nullable',
            'su.account_number' => 'nullable',
        ], [
            'su.name.required' => 'Required field',
            'su.name.max' => 'Maximum of 100 chars',
            'su.name.min' => 'At least 2 chars',

            'su.mobile_1.required' => 'Required field',

            'su.email.required' => 'Required field',
            'su.email.email' => 'Enter a valid email',
            'su.email.unique' => 'Email is taken already',

            'su.branch.required' => 'Required field',
            'su.branch.max' => 'Maximum of 255 chars',
            'su.branch.min' => 'At least 2 chars',

            'su.address.required' => 'Required field',
            'su.address.max' => 'Maximum of 255 chars',
            'su.address.min' => 'At least 2 chars',
        ]);
    }

    public function create_or_update()
    {
        if ($this->hasPermission('supplier-manage')) return;

        $this->validate_first();
        
        empty($this->su['id'])
            ? $this->create_supplier()
            : $this->update_supplier();
    }

    public function create_supplier()
    {
        try {
            Supplier::create($this->set_supplier());

            $this->trait_user_activity_supplier_create();

            $this->modal('close');
            $this->reset(['su']);
            $this->resetValidation();
            $this->toast('success', 'Supplier has been added successfully.');
            $this->emit('refreshSupplierIndex');
        } catch (\Exception $wtf) { $this->toastError(); }

    }

    public function update_supplier()
    {
        try {
            Supplier::findOrFail($this->su['id'])->update($this->set_supplier());

            $this->trait_user_activity_supplier_update();

            $this->modal('close');
            $this->reset(['su']);
            $this->resetValidation();
            $this->toast('success', 'Supplier has been updated successfully.');
            $this->emit('refreshSupplierIndex');
        } catch (\Exception $wtf) {  $this->toastError(); }
    }

    public function edit_supplier($supplier_id)
    {
        try {
            $this->resetValidation();
            $this->su['id'] = $supplier_id;

            $supplier = Supplier::findOrFail($this->su['id']);
            $this->su['code']            = $supplier->code;
            $this->su['name']            = $supplier->name;
            $this->su['mobile_1']        = $supplier->mobile_1;
            $this->su['mobile_2']        = $supplier->mobile_2;
            $this->su['email']           = $supplier->email;
            $this->su['branch']          = $supplier->branch;
            $this->su['address']         = $supplier->address;
            $this->su['account_name']    = $supplier->account_name;
            $this->su['account_number']  = $supplier->account_number;
            $this->modal('show');

        } catch(\Exception $wtf) { $this->toastError(); }
    }


    public function modal_show() 
    {
        if ($this->hasPermission('supplier-manage')) return;
        
        $this->reset(['su']);
        $this->modal('show');
    }
}