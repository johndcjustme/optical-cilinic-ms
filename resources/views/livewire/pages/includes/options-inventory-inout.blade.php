<x-layouts.main-content-controls>
    <div></div>
    <div class="d-flex gap-3">

        {{-- @include('livewire.pages.includes.filterize')   --}}
        <x-organisms.with-filter class="dropdown-menu-end"/>

        <x-atoms.search w-model="search"/>
    </div>   
</x-layouts.main-content-controls>