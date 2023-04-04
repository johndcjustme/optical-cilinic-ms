@php
    $disabled = count($selected_items) == 0 ? 'disabled' : '';
@endphp

<x-layouts.main-content-index>
    <x-layouts.main-content-nav page-title="Appointment"/>
    <x-layouts.main-content-controls>
        <div>
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10" {{ $disabled }}>Options </button>
            <ul class="dropdown-menu">
                <li><h6 class="dropdown-header text-start">Update Status</h6></li>
                @foreach ($this->from_trait_pt_appointment_status as $status)
                    <li><a {!! $this->confirm_update_status($status['value']) !!} class="dropdown-item" href="#" {{ $disabled }}>{{ $status['title'] }}</a></li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header text-start">More</h6></li>
                <li><a class="dropdown-item" {!! $this->deleting_appts() !!} href="#" {{ $disabled }}><i class="bi bi-trash"></i> Delete</a></li>
            </ul>
        </div>
        <div></div>
    </x-layouts.main-content-controls>

    <x-layouts.main-content-content>
        <x-organisms.table-index with-card>
            <x-slot name="thead">
                <x-organisms.table-th-checkbox/>
                <x-organisms.table-th text="#" style="width: 2em;"/>
                <x-organisms.table-th text="Status"/>
                <x-organisms.table-th text="Appt Date"/>
                <x-organisms.table-th text="Name" sort-column="name" :direction="$orderBy === 'name' ? $sortDirection : null"/>
                <x-organisms.table-th text="Contact"/>
                <x-organisms.table-th text="Date created" sort-column="id" :direction="$orderBy === 'id' ? $sortDirection : null" style="width: 8em;"/>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($appointments as $key => $appointment)
                    <tr>
                        <x-organisms.table-td-checkbox
                            :value="$appointment->id" 
                            w-model="selected_items"/>
                        <x-organisms.table-td :desc="$appointments->firstItem() + $key"/>
                        <x-organisms.table-th 
                            :text="$appointment->current_status"/>
                        <x-organisms.table-td 
                            :text="$appointment->date"
                            :desc="$appointment->time"/>
                        <x-organisms.table-th 
                            scope="row"
                            :text="$appointment->patient->name"
                            :desc="Str::limit($appointment->patient->address, 30)"
                            :desc-title="$appointment->patient->address"/>
                        <x-organisms.table-td 
                            :text="$appointment->patient->mobile_1"
                            :desc="$appointment->patient->email"/>
                        <x-organisms.table-td 
                            :text="$appointment->created_at->format('M-d-Y')"/>
                    </tr>
                @empty
                    <tr>
                        <x-organisms.table-td colspan="7" class="text-center" text="No Data."/>
                    </tr>
                @endforelse
            </x-slot>
        </x-organisms.table-index>
    </x-layouts.main-content-content>
</x-layouts.main-content-index>
