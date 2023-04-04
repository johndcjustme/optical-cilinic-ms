@php
    $disabled = count($selected_items) <= 0 ? 'disabled' : '';    
@endphp

<x-layouts.main-content-controls>

    <div>
        <div class="btn-group">
            <x-atoms.button w-click="$emit('modal_show')" text="Create" icon="bi-plus-lg" class="btn-primary"/>

            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10"></button>
            <ul class="dropdown-menu">
                {{-- <li><h6 class="dropdown-header text-start">Update status</h6></li>
                @foreach ($from_trait_reorder_status as $status)
                    @php $disabled = $status['value'] == $current_reorder_status ? 'disabled' : ''; @endphp
                    <li><a wire:click.prevent="update_order_status({{ $status['value'] }})" class="dropdown-item {{ $disabled }}" href="#">{{ $status['title'] }}</a></li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header text-start">More</h6></li>
                <li><a wire:click.prevent="download" class="dropdown-item" href="#"><i class="bi bi-file-pdf"></i> Export to pdf</a></li> --}}
                <li><a {!! $this->deleting_suppliers() !!} class="dropdown-item {{ $disabled }}" href="#"><i class="bi bi-trash"></i> Delete</a></li>
            </ul>
            {{-- <div class="btn-group" role="group">
                <x-atoms.button w-click="delete_supplier" text="Delete" icon="bi-trash" class="btn-danger"/>
                <x-atoms.button w-click="$set('selected_items', [])" icon="bi-x-lg" class="btn-secondary ml-4" title="Close"/>
            </div> --}}
        </div>
    </div>

    <x-atoms.search w-model="search" placeholder="Search by Name"/>
</x-layouts.main-content-controls>
