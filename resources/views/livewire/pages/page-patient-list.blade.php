<x-layouts.main-content-content>    
    <x-organisms.table-index :paginate="$patients" with-card>
        <x-slot name="thead">
            <x-organisms.table-th-checkbox/>
            <x-organisms.table-th text="#" style="width: 2em;"/>
            <x-organisms.table-th style="width:6em;"/>
            <x-organisms.table-th text="Name" sort-column="name" :direction="$orderBy === 'name' ? $sortDirection : null"/>
            <x-organisms.table-th text="Age" sort-column="age" :direction="$orderBy === 'age' ? $sortDirection : null"/>
            <x-organisms.table-th text="Contact"/>
            <x-organisms.table-th text="Occupation"/>
            <x-organisms.table-th text="Membership"/>
            <x-organisms.table-th text="Date added" sort-column="id" :direction="$orderBy === 'id' ? $sortDirection : null" style="width: 8em;"/>
            <x-organisms.table-th-action/>
        </x-slot>
        <x-slot name="tbody">
            @forelse ($patients as $key => $pt)
                <tr class="{{ ($pt->queue == 1) || ($pt->queue == 2) ? 'table-primary' : '' }} {{ $pt->appointment ? 'table-success' : '' }}">
                    <x-organisms.table-td-checkbox
                        :value="$pt->id"
                        w-model="selected_items"/>
                    <x-organisms.table-td :desc="$patients->firstItem() + $key"/>
                    <x-organisms.table-td>
                        <x-atoms.button w-click="patient_exam({{ $pt->id }})" text="Exam" icon="bi-pencil" class="d-flex gap-1 btn-outline-success btn-sm"/>
                    </x-organisms.table-td> 
                    <x-organisms.table-th 
                        scope="row" 
                        :text="$pt->name"
                        :desc="Str::limit($pt->address, 30)"
                        :desc-title="$pt->address"/>
                    <x-organisms.table-td 
                        :text="$pt->age"
                        :desc="$pt->pt_gender"/>
                    <x-organisms.table-td 
                        :text="$pt->mobile_1"
                        :desc="$pt->email"/>
                    <x-organisms.table-td
                        :text="Str::limit($pt->occupation, 30)"/>
                    <x-organisms.table-td
                        :text="$pt->membership"/>
                    <x-organisms.table-td 
                        :desc="$pt->created_at"/>
                    <x-organisms.table-td-action
                        edit="$emit('edit', {{ $pt->id }})"/>
                </tr>
            @empty 
                <x-organisms.table-td colspan="8" class="text-center" text="Not data found."/> 
            @endforelse
        </x-slot>
    </x-organisms.table-index>
</x-layouts.main-content-content>
