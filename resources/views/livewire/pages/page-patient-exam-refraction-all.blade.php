@foreach ($refractions as $rf)
<div class="card">
  <div class="card-body">

      @if (!empty($this->rf['refraction_id']))
        <div>
          <div class="d-flex align-items-center justify-content-between pt-4 pb-5">
            {{-- <div>ex
              <x-atoms.button w-click="confirm_delete_refraction" class="btn-outline-secondary" text="Delete" icon="bi-trash"/>
            </div> --}}

            <div class="text-muted">
              {{-- {{ $rf->created_at }} --}}
            </div>

            <div>
              <x-atoms.button w-click="confirm_delete_refraction({{ $rf->id }})" class="btn-outline-success" icon="bi-trash"/>
            </div>

            {{-- <div class="d-flex gap-3">
              <x-atoms.button class="btn-success" text="Save" type="submit" icon="bi-pencil-square"/>
            </div> --}}
          </div>
          
          <x-organisms.table-index class="table-borderless">php
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

      @else
        <div class="py-4 text-center">
          <x-atoms.button w-click="confirm_create_refraction" class="btn-lg btn-outline-success" text="Create New"/>
        </div>
      @endif

      <x-atoms.display-date :text="$rf->created_at"/>


  </div>
</div>
@endforeach