@php
    $disabled = count($selected_items) == 0 ? 'disabled' : '';
@endphp

<x-layouts.main-content-controls>
    <div>
        {{-- @if (count($selected_items) > 0)
            <div class="btn-group" role="group">
                <x-atoms.button w-click="delete_supplier" text="Delete" icon="bi-trash" class="btn-danger"/>
                <x-atoms.button w-click="$set('selected_items', [])" icon="bi-x-lg" class="btn-secondary ml-4" title="Close"/>
            </div>
        @else
        @endif --}}
        <div class="btn-group">
            <x-atoms.button w-click="modal_show" text="Create" icon="bi-plus-lg" class="btn-primary"/>
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10"></button>
            <ul class="dropdown-menu">
                <li><a {!! $this->deleting_categories() !!} class="dropdown-item {{ $disabled }}" href="#"><i class="bi bi-trash"></i> Delete</a></li>
            </ul>
        </div>
    </div>

    <div class="d-flex gap-3">
        <x-atoms.search w-model="search" placeholder="Search by Title"/>
        {{-- <div>
            <x-molecules.dropdown-index id="inventory-order-dropdown-right">
                <x-molecules.dropdown-item-paginate :paginate="$paginate" class="dropstart"/>
            </x-molecules.dropdown-index>
        </div> --}}
    </div>
</x-layouts.main-content-controls>