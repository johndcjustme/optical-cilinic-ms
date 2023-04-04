<x-layouts.main-content-nav page-title="Payments">
    <x-layouts.main-content-nav-item w-click="$set('detail_id', '')" text="Payments" class="{{ $this->detail_id == '' ? 'active' : null }}"/>
    @if (!empty($this->detail_id))
        <x-layouts.main-content-nav-item text="Payment Detail" class="{{ !empty($this->detail_id) ? 'active' : null }}"/>
    @endif
</x-layouts.main-content-nav>