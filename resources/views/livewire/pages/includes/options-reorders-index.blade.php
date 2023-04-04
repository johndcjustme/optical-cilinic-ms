@php
    $btn_options_is_disabled = count($selected_items) <= 0 ? 'disabled' : '';
@endphp

<x-layouts.main-content-controls>
    <div class="d-flex align-items-center gap-3">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10" {{ $btn_options_is_disabled }}>
                Options
            </button>
            <ul class="dropdown-menu">
                <li><h6 class="dropdown-header text-start">Update status</h6></li>
                @foreach ($from_trait_reorder_status as $status)
                    @php $disabled = $status['value'] == $current_reorder_status ? 'disabled' : ''; @endphp
                    <li><a {!! $this->update_order_status_confirm($status['title'], $status['value']) !!} class="dropdown-item {{ $disabled }}" href="#">{{ $status['title'] }}</a></li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><a wire:click.prevent="download" class="dropdown-item" href="#"><i class="bi bi-file-pdf"></i> Export to pdf</a></li>
                <li><a {!! $this->deleting_reorders() !!} class="dropdown-item" href="#"><i class="bi bi-trash"></i> Cancel</a></li>
            </ul>
        </div>
    </div>
    <div></div>
</x-layouts.main-content-controls>