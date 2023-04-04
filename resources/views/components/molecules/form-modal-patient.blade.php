@extends('components.organisms.modal-index', ['maxwidth' => '900px;'])

@section('content')
    @if ($this->modal)
        <x-organisms.modal-content w-submit="create_or_update" :modal-title="empty($this->pt['id']) ? 'Add' : 'Edit'">
            <div class="row g-5">
                <div class="col-sm-12 col-md-6">
                    <x-organisms.modal-title-2 text="Perosnal Info"/>
                    <div class="row g-3">
                        <x-atoms.input w-model="pt.name" label="Name (Lastname, Firstname M.I. (suffix))" :error="'pt.name'" class="col-12" floating required/>
                        <x-atoms.input w-model="pt.address" label="Address" :error="'pt.address'" class="col-md-6" floating/>
                        <x-atoms.input w-model="pt.occupation" label="Occupation" :error="'pt.occupation'" class="col-md-6" floating/>
                        <x-atoms.input w-model="pt.age" label="Age" type="number" :error="'pt.age'" class="col-md-4" floating required/>
                        <x-atoms.input w-model="pt.gender" label="Gender" :error="'pt.gender'" class="col-md-4" select floating required>
                            <option selected hidden>Select</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </x-atoms.input>
                        <x-atoms.input w-model="pt.created_at" label="Date Added" :error="'pt.created_at'" class="col-md-4" type="date" floating/>
                    </div>
                    <x-organisms.modal-title-2 text="Contact Details" class="mt-4"/>
                    <div class="row g-3">
                        <x-atoms.input w-model="pt.mobile_1" label="Mobile Number" type="tel" maxLength="11" pattern="[0-9]{3}[0-9]{4}[0-9]{4}" placeholder="(eg) 09484710737" :error="'pt.mobile_1'" class="col-md-6" floating/>
                        <x-atoms.input w-model="pt.email" label="Email" type="text" :error="'pt.email'" class="col-md-6" floating/>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <x-organisms.modal-title-2 text="Purpose"/>
                    <div class="d-flex flex-wrap gap-4">
                        @foreach ($this->from_trait_pt_purpose as $purpose)
                            <div class="form-check mb-4">
                                <input wire:model="pt.purpose" value="{{ $purpose['value'] }}" type="radio" class="form-check-input" id="purpose-{{ $purpose['value'] }}">
                                <label for="purpose-{{ $purpose['value'] }}" class="form-check-label">{{ $purpose['purpose'] }}</label>
                            </div>
                        @endforeach
                    </div>

                    @permission('patient-appointment-manage')
                        <x-organisms.modal-title-2 text="Appointment"/>
                        <div class="row g-3 mb-4">
                            <x-atoms.input w-model="pt.appointment_date" label="Appointment" type="date" :error="'pt.appointment_date'" class="col-md-6 col-sm-12" floating />
                        </div>
                    @endpermission

                    <x-organisms.modal-title-2 text="More" class="mt-4"/>
                    <div class="form-check pb-2">
                        <input wire:model="pt.queue" type="checkbox" class="form-check-input" id="ready-for-exam">
                        <label for="ready-for-exam" class="form-check-label">Add to Queue</label>
                    </div>

                    <div class="form-check">
                        <input wire:model="pt.is_member" type="checkbox" class="form-check-input" id="membership">
                        <label for="membership" class="form-check-label">King Coop. Member</label>
                    </div>
                </div>
            </div>
        </x-organisms.modal-content>
    @endif
@endsection

