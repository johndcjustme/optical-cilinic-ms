``@extends('components.organisms.modal-index')


@section('content')
    @if ($this->modal)
        <x-organisms.modal-content w-submit="create_or_update" :modal-title="!empty($this->su['id']) ? 'Edit' : 'Add'">
            <x-organisms.modal-title-2 text="Supplier Details"/>
            <div class="row g-3">
                <x-atoms.input w-model="su.name" label="Name" :error="'su.name'" class="col-md-8" floating required/>
                <x-atoms.input w-model="su.code" label="Code" :error="'su.code'" class="col-md-4" floating/>
                <x-atoms.input w-model="su.branch" label="Branch" :error="'su.branch'" class="col-12" floating required/>
                <x-atoms.input w-model="su.address" label="Address" :error="'su.address'" class="col-12" floating required/>
            </div>
            <x-organisms.modal-title-2 text="Contact Details" class="mt-4"/>
            <div class="row g-3">
                <x-atoms.input w-model="su.mobile_1" label="Mobile Number" type="tel" maxLength="11" pattern="[0-9]{3}[0-9]{4}[0-9]{4}" placeholder="(eg) 09484710737" :error="'su.mobile_1'" class="col-md-6" floating required/>
                <x-atoms.input w-model="su.email" label="Email" type="email" :error="'su.email'" class="col-md-6" floating required/>
            </div>
            <x-organisms.modal-title-2 text="Account Details" class="mt-4"/>
            <div class="row g-3">
                <x-atoms.input w-model="su.account_name" label="Account Name" :error="'su.account_name'" class="col-md-6" floating/>
                <x-atoms.input w-model="su.account_number" label="Account Number" :error="'su.account_number'" class="col-md-6" floating/>
            </div>
        </x-organisms.modal-content>
    @endif

@endsection

