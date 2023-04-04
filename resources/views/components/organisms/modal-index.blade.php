<div wire:ignore.self class="modal fade" id="x-modal{{ $modal_id ?? '' }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog" style="max-width: {{ $maxwidth  ?? '' }};">
        @yield('content')        
    </div>
</div>