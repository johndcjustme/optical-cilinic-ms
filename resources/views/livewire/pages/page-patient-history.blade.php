{{-- The Master doesn't talk, he acts. --}}
<div class="row g-4">
    @forelse ($exams as $rf)
        <div class="col-md-6 col-sm-12 col-xxl-6">
            <div class="card card-body pt-4">
                <div class="card-title text-success m-0 pb-4 pt-0">{{ $rf->created_at }}</div>
                <x-organisms.table-index class="table-borderless">
                    <x-slot name="thead">
                    <x-organisms.table-th text="RX"/>
                    <x-organisms.table-th text="SPH"/>
                    <x-organisms.table-th text="CYL"/>
                    <x-organisms.table-th text="AXIS"/>
                    <x-organisms.table-th text="NVA"/>
                    <x-organisms.table-th text="PH"/>
                    <x-organisms.table-th text="CVA"/>
                    </x-slot>
                
                    <x-slot name="tbody">
                    <tr>
                        <x-organisms.table-th scope="row" text="OD"/>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OD_SPH }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OD_CYL }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OD_AXIS }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OD_NVA }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OD_PH }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OD_CVA }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                    </tr>
                    <tr>
                        <x-organisms.table-th scope="row" text="OS"/>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OS_SPH }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OS_CYL }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OS_AXIS }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OS_NVA }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OS_PH }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                        <x-atoms.input value="{{ $rf->OS_CVA }}" placeholder="" readonly/>
                        </x-organisms.table-td>
                    </tr>
                    <tr>
                        <x-organisms.table-td text=""/>
                        <x-organisms.table-td colspan="3">
                        <b>ADD</b>
                        <x-atoms.input value="{{ $rf->ADD }}" class="mt-2" placeholder="" readonly/>
                        </x-organisms.table-td>
                        <x-organisms.table-td colspan="3">
                        <b>P.D.</b>
                        <x-atoms.input value="{{ $rf->PD }}" class="mt-2" placeholder="" readonly/>
                        </x-organisms.table-td>
                    </tr>
                    <tr>
                        <x-organisms.table-td/>
                        <x-organisms.table-td colspan="6">
                        <b>REMARKS</b>
                        <x-atoms.input rows="3" class="mt-2" placeholder="" style="" readonly textarea>
                            {{ $rf->remarks }}
                        </x-atoms.input>
                        </x-organisms.table-td>
                    </tr>
                    </x-slot>
                </x-organisms.table-index>
            </div>
        </div>


    @empty
        <div class="pb-2 text-center">No Data.</div>
    @endforelse

</div>