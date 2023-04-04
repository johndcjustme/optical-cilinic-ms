@props([
    'confirm' => 'confirm',
    'id' => 'x-confirm',
    'id2' => 'x-confirm-modal',
    // 'emit' => '',
    // 'param' => '',
])

<div id="{{ $id }}" class="modal x-confirm" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 25em;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="confirm-title" class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="confirm-body" class="modal-body"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 6em;">No</button>
                <button wire:click.prevent="{{ $confirm }}" type="button" class="btn btn-primary" style="width: 6em; margin-left:0.5em;">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- confirm modal 2 -->
{{-- <div id="{{ $id2 }}" class="modal x-confirm-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 25em;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="confirm-title" class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="confirm-body" class="modal-body"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 6em;">No</button>
                <button onclick="Livewire.emit(@js($emit), @js($param))" type="button" class="btn btn-primary btn-confirm" style="width: 6em; margin-left:0.5em;">Yes</button>
            </div>
        </div>
    </div>
</div> --}}



