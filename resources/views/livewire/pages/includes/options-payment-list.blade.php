<x-layouts.main-content-controls>
    <div class="d-flex gap-3">
        <x-organisms.with-filter :count="$filter_count_purchases"/>
    </div>

    <div class="d-flex gap-3">
        {{-- <x-atoms.search w-model="search"/> --}}
    </div>
</x-layouts.main-content-controls>