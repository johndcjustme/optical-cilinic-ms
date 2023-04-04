@php
    $dismissible = $dismiss ? 'alert-dismissible' : null;
@endphp

<div {{ $attributes->merge(['class' => 'alert fade show ' . $dismissible, 'style' => '' ]) }} role="alert">
    @if (!is_null($icon))
        <i class="bi {{ $icon }} me-1"></i>
    @endif
    @if (!is_null($title))
        <h4 class="alert-heading">{{ $title }}</h4>
    @endif
    @if (!is_null($textBody))
        {{ $textBody }}
    @endif
    @if (!is_null($textFooter))
        <hr>
        <p class="mb-0">{{ $textFooter }}</p>
    @endif
    @if (!is_null($dismiss))
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>