@php
    $disabled = count($selected_items) == 0 ? 'disabled' : '';
@endphp

<x-layouts.main-content-controls>
    <div class="btn-group">
        <x-atoms.button w-click="modal_show" text="Create" icon="bi-plus-lg" class="btn-primary"/>
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10"></button>
        <ul class="dropdown-menu">
            <li><a {!! $this->deleting_categories() !!} class="dropdown-item {{ $disabled }}" href="#"><i class="bi bi-trash"></i> Delete</a></li>
        </ul>
    </div>

    <div>
        <x-atoms.search w-model="search" placeholder="Search by Title"/>
    </div>
</x-layouts.main-content-controls>