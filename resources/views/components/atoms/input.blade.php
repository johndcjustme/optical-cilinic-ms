@props([
    'isInvalid' => null, 
    'readonly' => null,
])

@php
    $error_message = '';
@endphp

@if (!is_null($error))
    @error($error)
        @php
            $error_message = '[' . $message . ']';
            $isInvalid = 'is-invalid';
        @endphp
    @enderror
@endif


@if (!is_null($floating))
    <div {{ $attributes->merge(['class' => '']) }}>
        <div class="form-floating">
            @if (!is_null($textarea))
                <textarea 
                    @if ($wModel)
                        wire:model.defer="{{ $wModel }}"
                    @endif
                    placeholder="Enter {{ $label }}..." 
                    class="form-control {{ $isInvalid }}" 
                    id="input-{{ $label }}" 
                    style="height: 100px;"
                    @if(!is_null($required)) 
                        required 
                    @endif>
                </textarea>
            @elseif (!is_null($select))
                <select 
                    @if ($wModel)
                        wire:model.defer="{{ $wModel }}" 
                    @elseif ($wModelNodefer)
                        wire:model="{{ $wModelNodefer }}" 
                    @endif
                    class="form-select {{ $isInvalid }}" 
                    id="select-{{ $label }}" 
                    @if(!is_null($required)) 
                        required 
                    @endif>
                        {{ $slot }}
                </select>
            @else
                <input 
                    @if ($wModel)
                        wire:model.defer="{{ $wModel }}" 
                    @endif
                    id="input-{{ $label }}" 
                    {{ $attributes->merge([
                        'class' => 'form-control ' . $isInvalid, 
                        'type' => 'text', 
                        'min' => '',
                        'max' => '',
                        'maxLength' => '',
                        'step' => '',
                        'list' => '',
                        'placeholder' => 'Enter ' . Str::lower($label) . '...'
                    ]) }}
                    @if(!is_null($required)) 
                        required
                    @endif>
            @endif
            <label for="input-{{ $label }}">{{ $label }}<span class="text-danger">@if (!is_null($required)) * @endif {{ $error_message }}</span></label>
        </div>
    </div>

@else <!--not a floating input -->

    <div {{ $attributes->merge(['class' => 'form-group']) }}>
        @if (!is_null($label))
                <label class="w-100 form-label" style="margin-bottom: 0.4rem;">
                    <div class="d-flex justify-content-between align-items-end w-100">
                        <span>
                            {{ $label }} @if (!is_null($required)) <span class="text-danger">*</span> @endif
                        </span>
                        <small class="text-danger">
                            {{ $error_message }}
                        </small>
                    </div>
                </label>
        @endif

        @if ($select)
                <select 
                    @if ($wModel && !$nodefer)
                        wire:model.defer="{{ $wModel }}" 
                    @elseif ($wModel && $nodefer)
                        wire:model="{{ $wModel }}" 
                    @endif
                    class="form-select">
                        {{ $slot }}
                </select>

        @elseif ($textarea) 

                <textarea class="form-control" 
                    {{ $attributes->merge([
                        'rows' => '', 
                        'style' => '', 
                        'placeholder' => 'Enter ' . Str::lower($label) . '...'
                    ]) }}
                    @if (!is_null($wModel))
                        wire:model.defer="{{ $wModel }}"
                    @endif
                    @if (!is_null($readonly))
                        readonly
                    @endif>{{ $slot }}</textarea>

        @elseif ($checkbox || $radio) 
                @php $type = $checkbox ? 'checkbox' : 'radio'; @endphp
                <input 
                    @if ($wModel && !$nodefer)
                        wire:model.defer="{{ $wModel }}" 
                    @elseif ($wModel && $nodefer)
                        wire:model="{{ $wModel }}" 
                    @endif
                    value="{{ $checkboxValue }}" 
                    type="{{ $type }}" 
                    class="form-check-input" 
                    id="checkbox-{{ $checkboxText }}">

                @if ($checkboxText)
                    <label 
                        class="pl-2 {{ $labelClass }}" 
                        for="checkbox-{{ $checkboxText }}">
                            {{ $checkboxText }}
                    </label> 
                @endif

        @else
                <div class="{{ is_null($group) ?: 'input-group' }}">
                    @if (!is_null($group)) 
                        <span class="input-group-text">{{ $group ?? $slot }}</span> 
                    @endif
                    <input 
                        @if (!is_null($wModel) && !$nodefer)
                            wire:model.defer="{{ $wModel }}" 
                        @elseif (!is_null($wModel) && $nodefer)
                            wire:model="{{ $wModel }}" 
                        @endif
                        class="form-control {{ $isInvalid }}"
                        {{ $attributes->merge([
                            'value' => '',
                            'type' => 'text', 
                            'min' => '',
                            'max' => '',
                            'maxLength' => '',
                            'step' => '',
                            'placeholder' => 'Enter ' . Str::lower($label) . '...'
                        ]) }} 
                        @if(!is_null($required)) 
                            required 
                        @endif
                        @if(!is_null($readonly)) 
                            readonly 
                        @endif>

                </div>
        @endif
    </div>

@endif