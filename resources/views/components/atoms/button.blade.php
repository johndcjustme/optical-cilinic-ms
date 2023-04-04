<button @if (!is_null($wClick)) wire:click.prevent="{{ $wClick }}" @endif {{ $attributes->merge(['class' => 'btn', 'type' => 'button', 'style' => '', 'title' => '']) }}>
    @if (!is_null($icon))
        <i 
            wire:loading.delay.remove 
            wire:target="{{ $wClick }}" 
            class="bi {{ $icon }}"></i> 
        <i 
            wire:loading.delay 
            wire:target="{{ $wClick }}" 
            class="spin-me bi bi-arrow-clockwise"></i>
    @endif
    <span>
        {{ $text }}
    </span>
    {{ $slot }}
</button>