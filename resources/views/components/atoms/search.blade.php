<div class="position-relative">
    <input wire:model.debounce.500ms="{{ $wModel }}" {{ $attributes->merge(['class' => 'form-control bg-white', 'style' => 'padding-left:2.3em; width:100%; max-width:20em;', 'type' => 'text', 'title' => '', 'placeholder' => 'Search']) }}>
    <span class="position-absolute" style="top:0.5em; left:0.7em">
        <i class="bi bi-search"></i>
    </span>
    <i wire:loading wire:target="{{ $wModel }}" wire:loading class="spin-me bi bi-arrow-clockwise position-absolute opacity-50" style="top:0.45em; right:0.7em"></i>
</div>