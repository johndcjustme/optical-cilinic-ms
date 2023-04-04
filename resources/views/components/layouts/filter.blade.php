@props(['key' => 'key'])

<div>
    <div class="my-4 pt-3 border-top" x-show="filter_data" x-transition.opacity.duration.300ms x-cloak wire:ignore.self wire:key="key{{ $key }}">
        <div class="d-flex align-items-center gap-4">
            <h6 class="pr-5 mb-0 fw-medium text-muted" style="width:5em; min-width:5em" title="Reset" wire:click.prevent="reset_filter"><i class="bi bi-funnel"></i> FILTER</h6>
            <div class="d-flex align-items-center gap-3">
                {{ $slot }}            
            </div>
        </div>
    </div>
</div>