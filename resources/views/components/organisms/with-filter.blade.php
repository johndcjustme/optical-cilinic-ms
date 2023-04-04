@props([
    'btnClass' => 'btn-outline-primary',
    'count' => ''
])

<div class="dropdown">
    <button type="button" class="btn {{ $btnClass }}" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-offset="0,10" wire:ignore.self>
        <i class="bi bi-filter"></i> {{ $this->filterCategory() }} {{ !empty($count) ? ' | ' . $count : ''; }}
    </button>
    <div {{ $attributes->merge(['class' => 'dropdown-menu dropdown-menu-start p-3']) }}" wire:ignore.self>
        <div>
            <div class="text-primary mb-3 d-flex align-items-center justify-content-between"> 
                <span><i class="bi bi-filter"></i> FILTER</span>
            </div>
            <div class="d-flex justify-content-between gap-4">
                <div class="d-flex flex-column">
                    <x-atoms.input w-model="filter.filter" checkbox-value="today" checkbox-text="Today" class="text-nowrap" radio nodefer/>
                    <x-atoms.input w-model="filter.filter" checkbox-value="yesterday" checkbox-text="Yesterday" class="text-nowrap" radio nodefer/>
                    <x-atoms.input w-model="filter.filter" checkbox-value="this_week" checkbox-text="This Week" class="text-nowrap" radio nodefer/>
                    <x-atoms.input w-model="filter.filter" checkbox-value="last_week" checkbox-text="Last Week" class="text-nowrap" radio nodefer/>
                </div>
                <div class="d-flex flex-column">
                    <x-atoms.input w-model="filter.filter" checkbox-value="this_month" checkbox-text="This Month" class="text-nowrap" radio nodefer/>
                    <x-atoms.input w-model="filter.filter" checkbox-value="last_month" checkbox-text="Last Month" class="text-nowrap" radio nodefer/>
                    <x-atoms.input w-model="filter.filter" checkbox-value="this_year" checkbox-text="This Year" class="text-nowrap" radio nodefer/>
                    <x-atoms.input w-model="filter.filter" checkbox-value="last_year" checkbox-text="Last Year" class="text-nowrap" radio nodefer/>
                </div>
            </div>
        </div>
        <li class="dropdown-divider my-3"></li>
        <div>
            <div class="mb-2">
                <x-atoms.input w-model="filter.filter" checkbox-value="date_single" checkbox-text="Specify Date" class="text-nowrap" radio nodefer/>
                <div @if ($this->filter['filter'] != 'date_single') style="opacity:0.5;" @endif>
                    <input wire:model="filter.date" type="date" class="form-control mt-1">
                </div>
            </div>
            <div>
                <x-atoms.input w-model="filter.filter" checkbox-value="date_range" checkbox-text="Date Range" class="text-nowrap" radio nodefer/>
                <div @if ($this->filter['filter'] != 'date_range') style="opacity:0.5;" @endif> 
                    <small class="opacity-75">Start</small> <input wire:model="filter.date_from" type="date" class="form-control mt-1">
                    <small class="opacity-75">End</small> <input wire:model="filter.date_to" type="date" class="form-control {{ !empty($this->filter['date_to']) && ($this->filter['date_to'] < $this->filter['date_from']) ? 'is-invalid' : null }}">
                </div>
            </div>
        </div>
    </div>
</div>