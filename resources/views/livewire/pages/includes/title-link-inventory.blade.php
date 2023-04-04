<x-layouts.main-content-nav page-title="Inventory">
    <x-layouts.main-content-nav-item w-click="$set('currentPage', '')" text="Items" class="{{ $currentPage == '' ? 'active' : null }}"/>
    {{-- <x-layouts.main-content-nav-item w-click="$set('currentPage', 'tint')" text="Tints" class="{{ $currentPage == 'tint' ? 'active' : null }}"/> --}}
    <x-layouts.main-content-nav-item w-click="$set('currentPage', 'in_out')" text="In/Out" class="{{ $currentPage == 'in_out' ? 'active' : null }}"/>
    {{-- <x-layouts.main-content-nav-item w-click="$set('currentPage', 'order')" text="Orders" class="{{ $currentPage == 'order' ? 'active' : null }}"/> --}}
    @role('super-admin')
        <x-layouts.main-content-nav-item w-click="$set('currentPage', 'category')" text="Category" class="{{ $currentPage == 'category' ? 'active' : null }}"/>
    @endrole
</x-layouts.main-content-nav>