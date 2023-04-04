@extends('components.organisms.modal-index')

@section('content')

    @if ($this->modal)
        
        <x-organisms.modal-content w-submit="create_or_update" :modal-title="!empty($this->item['id']) ? 'Edit' : 'Add'">

            <div class="row g-3">
                <x-atoms.input w-model="item.category_id" label="Category" :error="'item.category_id'" class="col-md-6 col-sm-12" required select floating>
                    <option selected hidden>Select Category</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                    @endforeach
                </x-atoms.input>
                <x-atoms.input w-model="item.supplier_id" label="Supplier" class="col-md-6 col-sm-12" :error="'item.supplier_id'" select floating>
                    <option selected hidden>Select Supplier</option>
                    <option value="">None</option>
                    @foreach ($suppliers as $su)
                        <option value="{{ $su->id }}">{{ $su->name }}</option>
                    @endforeach
                </x-atoms.input>
            </div>

            <x-organisms.modal-title-2 text="Item Details" class="mt-4"/>
            <div class="row g-3">
                <x-atoms.input w-model="item.name" label="Name" :error="'item.name'" class="col-8" required floating/>
                <x-atoms.input w-model="item.code" label="Code" :error="'item.code'" class="col-4" floating/>
                <x-atoms.input w-model="item.description" label="Description" :error="'item.description'" class="col-12" floating/>
            </div>  
            <div class="row g-3 mt-3">
                @permission('item-quantity-edit')
                    <x-atoms.input w-model="item.quantity" label="Quantity" type="number" min="0" :error="'item.quantity'" class="col-sm-4 col-md-3" floating/>
                @endpermission
                <x-atoms.input w-model="item.buffer" label="Buffer" type="number" min="0" :error="'item.buffer'" class="col-sm-4 col-md-3" floating/>
                <x-atoms.input w-model="item.unit" label="Unit" :error="'item.unit'" class="col-sm-4 col-md-3" floating/>
                <x-atoms.input w-model="item.size" label="Size" :error="'item.size'" class="col-sm-4 col-md-3" floating/>
            </div>

            <x-organisms.modal-title-2 text="Item Price" class="mt-4"/>
            <div class="row g-3">
                <x-atoms.input w-model="item.price_code" label="Price Code" type="text" :error="'item.price_code'" class="col-sm-4 col-md-4" floating/>
                @permission('item-price-edit')
                    <x-atoms.input w-model="item.price" label="Price" type="number" min="0" step="0.01" :error="'item.price'" class="col-sm-4 col-md-4" floating/>
                @endpermission
                @permission('item-cost-edit')
                    <x-atoms.input w-model="item.cost" label="Cost" type="number" min="0" step="0.01" :error="'item.cost'" class="col-md-4 col-sm-4" floating/>
                @endpermission
            </div>
            
            <x-organisms.modal-title-2 text="Lens" class="mt-4 mb-0"/>
            <details>
                <div class="row g-3 mt-1">
                    <x-atoms.input w-model="item.sph" label="SPH" :error="'item.sph'" class="col-md-6 col-sm-12" floating/>
                    <x-atoms.input w-model="item.cyl" label="CYL" :error="'item.cyl'" class="col-md-6 col-sm-12" floating/>
                </div>
            </details>
        </x-organisms.modal-content>
    @endif


@endsection