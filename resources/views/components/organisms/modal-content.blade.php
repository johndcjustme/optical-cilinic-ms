    <form class="modal-content" @if (!is_null($wSubmit)) wire:submit.prevent="{{ $wSubmit }}" @endif {{ $attributes->merge(['class' => '', 'style' => ''])}}>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ $modalTitle }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

            {{ $slot }}
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 5em;">Close</button>
            <button type="submit" class="btn btn-primary" style="width: 5em;">Save</button>
        </div>
    </form>