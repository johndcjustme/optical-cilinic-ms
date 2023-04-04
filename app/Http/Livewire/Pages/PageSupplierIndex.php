<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;

use App\Models\Supplier;

use App\Traits\Modal;
use App\Traits\WithSorting;
use App\Traits\SharedVariables;
use App\Traits\UserActivities;


class PageSupplierIndex extends Component
{
    use WithPagination;
    use Modal;
    use WithSorting;
    use SharedVariables;
    use UserActivities;

    public 
        $su = ['id'];
        // $delete = [
        //     'supplier' => false,
        //     'suppliers' => false,
        // ];

    protected $listeners = ['refreshSupplierIndex' => '$refresh', 'deleted_suppliers'];

    public function mount()
    {
        $this->orderBy = 'name';
    }

    public function render()
    {
        return view('livewire.pages.page-supplier-index' , [
            'suppliers' => Supplier::where('name', 'like', "%$this->search%") 
                ->orderBy($this->orderBy, $this->sortDirection)  
                ->simplePaginate(200),
        ]);
    }

    public function updatedPaginate()
    {
        $this->resetPage();
    }

    public function deleting_suppliers() 
    {
        return $this->confirmDialog('deleted_suppliers', 'Are you sure you want to delete selected Suppliers?');
    }
    
    // public function delete_supplier($supplier_id = null)
    // {
    //     if (is_null($supplier_id)) {
    //         $this->delete['suppliers'] = true;
    //         $this->confirmation('show', 'Are you sure', 'You want to delete selected suppliers?');
    //     } else {
    //         $this->su['id'] = $supplier_id;
    //         $this->delete['supplier'] = true;
    //         $this->confirmation('show', 'Delete Supplier', 'Are you sure you want to proceed?');
    //     }
    // }


    // public function deleted_supplier()
    // {
    //     try {
    //         $supplier = Supplier::destroy($this->su['id']);
    //         $this->reset(['su','delete']);
    //         $this->resetPage();
    //         $this->toast('success', 'Supplier has been deleted successfully');
    //     } catch (\Exception $wtf) { $this->toastError(); }
    // }

    public function deleted_suppliers()
    {
        if ($this->hasPermission('supplier-manage')) 
            return;

        if (count($this->selected_items) == 0) 
            return;

        try {
            Supplier::destroy($this->selected_items);

            $this->trait_user_activity_supplier_delete();

            $this->reset(['selected_items']);
            $this->resetPage();
            $this->toast('success', 'Suppliers has been deleted successfully');
        } catch (\Exception $wtf) { $this->toastError(); }
    }


    // public function confirm()
    // {
    //     $this->confirmation('close');

    //     ! $this->delete['supplier'] 
    //         ?: $this->deleted_supplier();
    //     ! $this->delete['suppliers'] 
    //         ?: $this->deleted_suppliers();
    // }
}
