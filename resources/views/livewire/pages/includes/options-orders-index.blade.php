@php
    $btn_option_is_disabled = count($selected_items) == 0 ? 'disabled' : '';
    $btn_downloadpdf_is_disabled = count($this->selected_items) <= 0 ? 'disabled' : '';
@endphp

<x-layouts.main-content-controls>
    <div class="d-flex align-items-center gap-3">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10" {{ $btn_option_is_disabled }}>
                Options
            </button>
            <ul class="dropdown-menu">
                <li><h6 class="dropdown-header text-start">Update status</h6></li>
                @foreach ($from_trait_order_status as $status)
                    @php $disabled = $status['value'] == $current_order_status ? 'disabled' : ''; @endphp
                    {{-- <li><a wire:click.prevent="update_order_status({{ $status['value'] }})" class="dropdown-item {{ $disabled }}" href="#">{{ $status['title'] }}</a></li> --}}
                    <li><a {!! $this->updating_order_status($status['value']) !!} class="dropdown-item {{ $disabled }}" href="#">{{ $status['title'] }}</a></li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header text-start">More</h6></li>
                {{-- <li><a wire:click.prevent="download" class="dropdown-item {{ $btn_downloadpdf_is_disabled }}" href="#"><i class="bi bi-file-pdf"></i> Export to pdf</a></li> --}}
                <li><a {!! $this->deleting_orders() !!} class="dropdown-item" href="#"><i class="bi bi-trash"></i> Delete</a></li>
            </ul>
        </div>
        <x-organisms.with-filter :count="$count_order_status"/>
        <button wire:click.prevent="download(1)" class="btn btn-outline-primary"><i class="bi bi-file-pdf"></i> Export Lens</button>
        <button wire:click.prevent="download(2)" class="btn btn-outline-primary"><i class="bi bi-file-pdf"></i> Export Frame</button>
    </div>
    <div></div>
</x-layouts.main-content-controls>