@php
    $indicator = [
        [
            'color' => 'white',
            'bgcolor' => 'primary',
            'hex' => '#0d6efd'
        ], [
            'color' => 'white',
            'bgcolor' => 'secondary',
            'hex' => '#6c757d'
        ], [
            'color' => 'white',
            'bgcolor' => 'success',
            'hex' => '#198754'
        ], [
            'color' => 'white',
            'bgcolor' => 'danger',
            'hex' => '#dc3545'
        ], [
            'color' => 'dark',
            'bgcolor' => 'warning',
            'hex' => '#ffc107'
        ], [
            'color' => 'dark',
            'bgcolor' => 'info',
            'hex' => '#0dcaf0'
        ], [
            'color' => 'white',
            'bgcolor' => 'dark',
            'hex' => '#000'
        ]
    ]
@endphp


@extends('components.organisms.modal-index')


@section('content')
    @if ($this->modal)
        <x-organisms.modal-content w-submit="create_or_update" :modal-title="!empty($this->cat['id']) ? 'Edit' : 'Add'">
            <div class="row g-3">
                <x-atoms.input w-model="cat.title" label="Title" :error="'cat.title'" class="col-12" required floating/>
                <x-atoms.input w-model="cat.description" label="Description" :error="'cat.description'" class="col-12" textarea floating/>
            </div>

            <div class="row mt-2">
                <div class="d-flex flex-wrap align-items-center gap-3 mt-2">
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Indicator
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach ($indicator as $indicate)
                                    <li><a wire:click.prevet="set_indicator('{{ $indicate['color'] }}', '{{ $indicate['bgcolor'] }}', '{{ $indicate['hex'] }}')" class="dropdown-item" href="#"><i class="bi bi-circle-fill text-{{ $indicate['bgcolor'] }}"></i> {{ Str::title($indicate['bgcolor']) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
        
                    <div>
                        @if (!empty($this->cat['bgcolor'] && !empty($this->cat['color'])))
                            <span class="badge font-sm rounded-pill bg-{{ $this->cat['bgcolor'] }} text-{{ $this->cat['color'] }}" style="font-weight: normal;">{{ $this->cat['title'] }}</span>
                        @endif
                    </div>
                </div>
            </div>
                
        </x-organisms.modal-content>
    @endif

@endsection

