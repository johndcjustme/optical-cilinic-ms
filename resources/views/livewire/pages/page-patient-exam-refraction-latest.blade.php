<div class="col">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div class="d-flex align-items-center flex-wrap">
            <h4 class="fw-bold pb-0 pt-0 ps-0 m-0 pe-3">Refraction</h4>
            <span class="text-primary"><i class="bi bi-hash"></i> {{ $this->rf['refraction_id'] }}</span>
        </div>

        <div class="d-flex gap-3">
            @if (!empty($this->rf['refraction_id']))
                <a href="/home/print/{{ $this->rf['refraction_id'] }}" target="_blank" class="btn btn-success"><i class="bi bi-printer-fill"></i></a>
            @endif
            <button {!! $this->creating_refraction() !!} class="btn btn-outline-success">Create New</button>
        </div>
    </div>

    @if (!empty($this->rf['refraction_id']))
        <form wire:submit.prevent="update_refraction" id="refraction-form">                
            <x-organisms.table-index class="table-borderless">
                <x-slot name="thead">
                    <x-organisms.table-th text="RX" />
                    <x-organisms.table-th text="SPH" />
                    <x-organisms.table-th text="CYL" />
                    <x-organisms.table-th text="AXIS" />
                    <x-organisms.table-th text="NVA" />
                    <x-organisms.table-th text="PH" />
                    <x-organisms.table-th text="CVA" />
                </x-slot>
                <x-slot name="tbody">
                    <tr>
                        <x-organisms.table-th scope="row" text="OD"/>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OD_SPH" :error="'error'" list="sph" placeholder="SPH"/>
                            {!! $this->detalist('sph', 0.01, 0.10, 0.01) !!}
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OD_CYL" :error="'error'" placeholder="CYL"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OD_AXIS" :error="'error'" placeholder="AXIS"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OD_NVA" :error="'error'" placeholder="NVA"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OD_PH" :error="'error'" placeholder="PH"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OD_CVA" :error="'error'" placeholder="CVA"/>
                        </x-organisms.table-td>
                    </tr>
                    <tr>
                        <x-organisms.table-th scope="row" text="OS"/>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OS_SPH" :error="'error'" placeholder="SPH"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OS_CYL" :error="'error'" placeholder="CYL"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OS_AXIS" :error="'error'" placeholder="AXIS"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OS_NVA" :error="'error'" placeholder="NVA"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OS_PH" :error="'error'" placeholder="PH"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td>
                            <x-atoms.input w-model="rf.OS_CVA" :error="'error'" placeholder="CVA"/>
                        </x-organisms.table-td>
                    </tr>
                    <tr>
                        <x-organisms.table-td text=""/>
        
                        {{-- <div class="col-md-6"> --}}
                        <x-organisms.table-td colspan="2">
                            <b>ADD</b>
                            <x-atoms.input w-model="rf.ADD" :error="'error'" class="mt-2" placeholder="ADD"/>
                        </x-organisms.table-td>
                        <x-organisms.table-td colspan="2">
                            <b>P.D.</b>
                            <x-atoms.input w-model="rf.PD" :error="'error'" class="mt-2" placeholder="P.D."/>
                        </x-organisms.table-td>
                        <x-organisms.table-td colspan="2">
                            <b>TINT</b>
                            <x-atoms.input w-model="rf.tint" :error="'error'" list="tint" class="mt-2" placeholder="TINT"/>
                            <datalist id="tint">
                                @foreach ($tints as $tint)
                                    <option value="{{ $tint->title }}">
                                @endforeach
                            </datalist>
                        </x-organisms.table-td>
                    </tr>
                    <tr>
                        <x-organisms.table-td/>
                        <x-organisms.table-td colspan="6">
                        <b>REMARKS</b>
                            <x-atoms.input w-model="rf.remarks" :error="'error'" rows="2" class="mt-2" placeholder="Enter Remarks..." textarea/>
                        </x-organisms.table-td>
                    </tr>
                    <tr>
                        <x-organisms.table-td/>
                        <x-organisms.table-td colspan="6">
                        <b>RECOMMENDATION</b>
                            <x-atoms.input w-model="rf.recommendation" :error="'error'" rows="2" class="mt-2" placeholder="Enter Recomendation..." textarea/>
                        </x-organisms.table-td>
                    </tr>
                </x-slot>
            </x-organisms.table-index>
        </form>
        <div class="d-flex align-items-start justify-content-between flex-wrap gap-4">
            <div>
              
                <a {!! $this->creating_purchase($this->rf['refraction_id']) !!} class="btn btn-primary">Reference Purchase</a>

            </div>
            @permission('patient-exam-manage')
                <div class="d-flex gap-3">
                    <a {!! $this->deleting_refraction($rf['refraction_id']) !!} hre="#" class="btn btn-outline-success">Delete</a>
                    <button {!! $this->updating_refraction() !!} type="submit" form="refraction-form" class="btn btn-success">Save</button>
                </div>
            @endpermission
        </div>


    @else
        <div class="py-4 text-center">
            No Data.
        </div>
    @endif
</div>
