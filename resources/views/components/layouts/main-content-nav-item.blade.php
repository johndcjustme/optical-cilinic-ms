<li class="nav-item">
    <a @if ($wClick) wire:click.prevent="{{ $wClick }}" @endif {{ $attributes->merge(['class' => 'nav-link'])}} aria-current="page" href="#">{{ $text }}</a>
</li>