<div>    
    @include('livewire.pages.includes.options-inventory-category')
        
    <x-layouts.main-content-content>
        
        <x-organisms.table-index with-card>
            <x-slot name="thead">
                <x-organisms.table-th-checkbox/>
                <x-organisms.table-th text="Id" style="width: 2em;"/>
                <x-organisms.table-th text="Indicator" />
                <x-organisms.table-th text="Title" sort-column="title" :direction="$orderBy === 'title' ? $sortDirection : null"/>
                <x-organisms.table-th text="Description"/>
                <x-organisms.table-th-action/>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($categories as $key => $cat)
                    <tr>
                        <x-organisms.table-td-checkbox 
                            :value="$cat->id" 
                            w-model="selected_items"/>
                        <x-organisms.table-td 
                            :desc="$cat->id"/>
                        <x-organisms.table-td>
                            <span class="badge font-sm rounded-pill bg-{{ $cat->bgcolor }} text-{{ $cat->color }}" style="font-weight: normal; font-size:0.65rem;">{{ $cat->title }}</span>
                        </x-organisms.table-td>
                        <x-organisms.table-th
                            scope="row" 
                            :text="$cat->title"/>
                        <x-organisms.table-td
                            scope="row" 
                            :text="$cat->description"/>
                        <x-organisms.table-td-action
                            edit="edit({{ $cat->id }})"/>
                            {{-- delete="delete({{ $cat->id }}, '{{ $cat->title }}')"/> --}}
                    </tr>
                @empty 
                    <x-organisms.table-td colspan="5" class="text-center" text="Not data found."/> 
                @endforelse
            </x-slot>
        </x-organisms.table-index>
    </x-layouts.main-content-content>
    
    
    <x-molecules.form-modal-inventory-category/>
    
    {{-- <x-organisms.confirm-dialog/> --}}

</div>    

