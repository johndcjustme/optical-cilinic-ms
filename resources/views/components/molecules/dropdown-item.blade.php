<li><a @if(!is_null($wClick)) wire:click.prevent="{{ $wClick }}" @endif {{ $attributes->merge(['class' => 'dropdown-item'])}} href="#">
    @if (!is_null($icon))
        <i class="bi {{ $icon }}"></i>
    @endif
    {{ $text ?? $slot }}
</a></li>
