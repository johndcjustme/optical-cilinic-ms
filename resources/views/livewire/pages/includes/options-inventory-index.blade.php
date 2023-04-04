@php
    $btn_option_is_disabled = count($selected_items) <= 0 ? true : false;
    $btn_disabled = $btn_option_is_disabled ? 'disabled' : '';
@endphp

<x-layouts.main-content-controls>
    <div class="d-flex gap-3">
        <div class="btn-group" role="group">
            <x-atoms.button w-click="$emit('modal_show')" text="Create" icon="bi-plus-lg" class="btn-primary"/>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10"></button>
                <ul class="dropdown-menu">
                    {{-- <li><a wire:click.prevent="make_order" class="dropdown-item {{ $btn_disabled }}" href="#"><i class="bi bi-cart-check-fill"></i> Mark as Order</a></li> --}}
                    <li><a {!! $this->deleting_items() !!} class="dropdown-item {{ $btn_disabled }}" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="form-check form-switch">
            <input wire:model="show_low_stocks" class="form-check-input" type="checkbox" role="switch" id="show-low-stocks">
            <label class="form-check-label" for="show-low-stocks">Low stocks</label>
        </div>
        <x-atoms.search w-model="search"/>
    </div>
</x-layouts.main-content-controls>