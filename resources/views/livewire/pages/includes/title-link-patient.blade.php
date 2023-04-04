<x-layouts.main-content-nav page-title="Patient">
    <x-layouts.main-content-nav-item w-click="$set('currentPage', '')" text="Queue" class="{{ $this->currentPage == '' ? 'active' : null }}"/>
    <x-layouts.main-content-nav-item w-click="$set('currentPage', 'patient_list')" text="Patient list" class="{{ $this->currentPage == 'patient_list' ? 'active' : null }}"/>
    @if ($this->currentPage == 'patient_exam')
        <x-layouts.main-content-nav-item text="Patient Exam" class="active"/>
    @endif
</x-layouts.main-content-nav>