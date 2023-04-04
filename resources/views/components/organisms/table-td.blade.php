<td {{ $attributes->merge(['class' => 'align-middle', 'colspan' => '', 'title' => ''])}}>
    @if ($text)
        <div class="{{ $textClass }}">
            @if ($icon)
                <i class="bi {{ $icon }}"></i>
            @endif
            {{ $text }}
        </div>    
    @endif
    @if ($desc)
        <small class="text-muted">
            @if ($descIcon) <i class="bi bi-{{ $descIcon }}"></i> @endif 
            {{ $desc }}
        </small>    
    @endif
    @if ($subDesc)
        <small class="text-muted">{{ $subDesc }}</small>    
    @endif
    {{ $slot }}
</td>