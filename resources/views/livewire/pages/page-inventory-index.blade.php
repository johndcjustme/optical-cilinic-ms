<x-layouts.main-content-index>
    
    @include('livewire.pages.includes.title-link-inventory')

    @if ($this->currentPage == 'category')
        @role('super-admin')
            @livewire('pages.page-inventory-category')
        @endrole
    @elseif ($this->currentPage == 'tint')
        @livewire('pages.page-inventory-tint')
    @elseif ($this->currentPage == 'in_out')
        @livewire('pages.page-inventory-in-out')
    {{-- @elseif ($this->currentPage == 'order')
        @livewire('pages.page-inventory-order') --}}
    @else
        @livewire('pages.page-inventory-items')
        @livewire('pages.page-inventory-index-modal')
    @endif

</x-layouts.main-content-index>