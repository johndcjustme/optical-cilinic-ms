<th @if (!is_null($sortColumn)) wire:click.prevent="orderBy('{{ $sortColumn }}')" @endif {{ $attributes->merge(['class'=>'align-middle', 'style' => '' . !is_null($sortColumn) ? 'cursor:pointer;' : '', 'scope' => 'col']) }} @if(!is_null($sortColumn)) title="Sort" @endif>
    <div class="d-flex gap-1">
        {{ $text }} 
        @if (!is_null($sortColumn) && !is_null($direction))
            <i class="bi bi-caret-{{ $direction == 'desc' ? 'down' : 'up' }}" title="{{ $direction }}"></i>
        @endif
    </div>
    @if ($desc || $subDesc)
        <div class="d-flex flex-column">
            @if ($desc)
                <small class="text-muted" style="width:100%; font-weight: normal" @if (!is_null($descTitle)) title="{{ $descTitle }}" @endif>{{ $desc }}</small>    
            @endif
            @if ($subDesc)
                <small class="text-muted" style="width:100%; font-weight: normal">{{ $subDesc }}</small>    
            @endif
        </div>
    @endif

    {{ $slot }}
    
</th>