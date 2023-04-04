

<x-layouts.main-content-index>
    <x-layouts.main-content-nav page-title="Supplier"/>
    
    @include('livewire.pages.includes.options-supplier-index')

    <x-layouts.main-content-content>
        <x-organisms.table-index with-card>
            <x-slot name="thead">
                <x-organisms.table-th-checkbox/>
                <x-organisms.table-th text="#"/>
                <x-organisms.table-th text="Code" style="width:3em"/>
                <x-organisms.table-th text="Name" sort-column="name" :direction="$orderBy === 'name' ? $sortDirection : null"/>
                <x-organisms.table-th text="Contact"/>
                <x-organisms.table-th text="Branch" sort-column="branch" :direction="$orderBy === 'branch' ? $sortDirection : null"/>
                <x-organisms.table-th text="Account"/>
                <x-organisms.table-th-action/>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($suppliers as $key => $su)
                    <tr>
                        <x-organisms.table-td-checkbox 
                            :value="$su->id" 
                            w-model="selected_items"/>
                        <x-organisms.table-td :desc="$suppliers->firstItem() + $key"/>
                        <x-organisms.table-td :text="$su->code"/>
                        <x-organisms.table-th 
                            scope="row" 
                            :text="$su->name"/>
                        <x-organisms.table-td 
                            :text="$su->mobile_numbers"
                            :desc="$su->email"/>
                        <x-organisms.table-td 
                            :text="$su->branch"
                            :desc="$su->address"/>
                        <x-organisms.table-td 
                            :text="$su->account_name"
                            :desc="$su->account_number"/>
                        <x-organisms.table-td-action class="text-end"
                            edit="$emit('edit_supplier', {{ $su->id }})">
                            {{-- delete="{!! $this->deleting_suppliers() !!}"> --}}
                        </x-organisms.table-td-action>
                    </tr>
                @empty 
                    <x-organisms.table-td colspan="7" class="text-center" text="Not data found."/> 
                @endforelse
            </x-slot>
        </x-organisms.table-index>
    </x-layouts.main-content-content>


    {{-- <x-molecules.form-modal-supplier/> --}}
    @livewire('pages.page-supplier-index-modal')



    {{-- <x-organisms.confirm-dialog/> --}}



</x-layouts.main-content-index>

