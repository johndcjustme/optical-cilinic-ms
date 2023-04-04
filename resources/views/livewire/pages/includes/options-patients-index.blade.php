@php
    $disabled = count($selected_items) == 0 ? 'disabled' : '';
@endphp

<x-layouts.main-content-controls>
    <div class="d-flex align-items-center gap-3">
        {{-- @if (count($selected_items) > 0)
            <div class="btn-group" role="group">
                <x-atoms.button w-click="delete" text="Delete" icon="bi-trash" class="btn-danger" />
                <x-atoms.button w-click="$set('selected_items', [])" icon="bi-x-lg" class="btn-secondary ml-4"
                    title="Close" />
            </div>
        @else
        @endif --}}
        <div class="btn-group">
            <x-atoms.button w-click="$emit('modal_show')" text="New Patient" icon="bi-plus-lg" class="btn-primary" />
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10"></button>
            <ul class="dropdown-menu">
                <li><a {!! $this->deleting_patients() !!} class="dropdown-item {{ $disabled }}" href="#"><i class="bi bi-trash"></i> Delete</a></li>
            </ul>
        </div>
        @if ($this->currentPage == 'patient_list')
            <x-organisms.with-filter :count="$count_patients"/>
        @endif
    </div>

    <div class="d-flex align-items-center gap-3">
        {{-- @if ($this->currentPage == 'patient_list')
            <x-atoms.filter-switch/>
        @endif                 --}}

        <x-atoms.search w-model="search" placeholder="Search by Name"/>
    </div>
</x-layouts.main-content-controls>