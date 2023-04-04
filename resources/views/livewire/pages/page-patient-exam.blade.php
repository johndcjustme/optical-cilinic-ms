<x-layouts.main-content-content>
    <x-organisms.about-patient :patient="$patient"/>

    @permission('patient-exam-manage')
        <div class="d-flex gap-3 align-items-center border-bottom mb-3">
            <x-atoms.button w-click="$toggle('show_history')" icon="bi-graph-up" class="btn-sm btn-outline-secondary mb-3">Exam History</x-atoms.button>
            {{-- <button wire:click.prevent="$toggle('show_history')" class="btn btn-sm btn-outline-secondary mb-3">Payment History</button> --}}
        </div>
    @endpermission

    @if ($this->show_history)
        @livewire('pages.page-patient-history', ['patient_id' => $patient_id])
    @else 
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="row g-5">
                            {{-- <div class="col-12 col-md-6"> --}}
                                @livewire('pages.page-patient-exam-refraction', ['patient_id' => $patient_id])
                            {{-- </div> --}}
                            {{-- <div class="col-12 col-md-6"> --}}
                                @livewire('pages.page-patient-exam-purchase', ['patient_id' => $patient_id])
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- @livewire('pages.page-patient-order', ['patient_id' => $patient_id]) --}}
        </div>
    @endif
</x-layouts.main-content-content>