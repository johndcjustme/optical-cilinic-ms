<div>    
    
    @include('livewire.pages.includes.options-inventory-inout')

    <x-layouts.main-content-content>
        
        <x-organisms.table-index :paginate="$items" with-card>
            <x-slot name="thead">
                <x-organisms.table-th text="Category" style="width:10em"/>
                <x-organisms.table-th text="Item" sort-column="name" :direction="$orderBy === 'name' ? $sortDirection : null"/>
                <x-organisms.table-th class="text-center" style="width: 7em;">
                    In
                </x-organisms.table-th>
                <x-organisms.table-th class="text-center" style="width: 7em;">
                    Out
                </x-organisms.table-th>
                <x-organisms.table-th class="text-center" style="width: 7em;">
                    Balance
                </x-organisms.table-th>
                <x-organisms.table-th style="width:15em;"/>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($items as $item)
                    <tr>
                        <x-organisms.table-td>
                            <span class="badge font-sm rounded-pill text-{{ $item->category->color }} bg-{{ $item->category->bgcolor }}" style="font-weight: normal; font-size:0.65rem;">{{ $item->category->title }}</span>
                        </x-organisms.table-td>
                        <x-organisms.table-th
                            scope="row"
                            :text="$item->name"
                            :desc="$item->size"/>
                        <x-organisms.table-td
                            class="text-center"
                            {{-- :text="$item->in_count"/> --}}
                            :text="$this->in($item->id)"/>
                        <x-organisms.table-td
                            class="text-center"
                            {{-- :text="$item->out_count"/> --}}
                            :text="$this->out($item->id)"/>
                        <x-organisms.table-td
                            class="table-active text-center"
                            {{-- :text="$item->in_count - $item->out_count"/> --}}
                            :text="($this->in($item->id) - $this->out($item->id))"/>
                        <x-organisms.table-td>
                            <div class="d-flex justify-content-end">
                                <a wire:click.prevent="view_in_out_details({{ $item->id }}, '{{ $item->name }}', '{{ $item->size }}')" href="#" class="link-primary">View Details</a>
                            </div>
                        </x-organisms.table-td>
                    </tr>
                @empty 
                    <x-organisms.table-td colspan="6" class="text-center" text="Not data found."/> 
                @endforelse
            </x-slot>
        </x-organisms.table-index>
    </x-layouts.main-content-content>
    










    <button id="view-in-out-details" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="display: none">Toggle right offcanvas</button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 30em">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">
                <div class="fw-bold">
                    {{ $this->view_in_out_details_name }}
                </div>
                <small class="text-muted">
                    {{ $this->view_in_out_details_size }}
                </small>
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <x-organisms.table-index>
                <x-slot name="thead">
                    <x-organisms.table-th>
                        <div class="text-center">
                            Date
                        </div>
                    </x-organisms.table-th>
                    <x-organisms.table-th/>
                    <x-organisms.table-th>
                        <div class="text-center">
                            Quantity
                        </div>
                    </x-organisms.table-th>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($in_out_items as $inout)
                        <tr class="{{ $inout->action ?: 'table-secondary' }}">
                            <x-organisms.table-td
                                class="text-center"
                                :text="$inout->created_at"/>
                            <x-organisms.table-td
                                class="text-center "
                                :text="$inout->action ? 'IN' : 'O'"/>
                            <x-organisms.table-td
                                class="text-center"
                                :text="$inout->quantity"/>
                        </tr>
                    @empty 
                        <x-organisms.table-td colspan="6" class="text-center" text="Not data found."/> 
                    @endforelse
                </x-slot>
            </x-organisms.table-index>
        
        </div>
    </div>

    
    <x-organisms.confirm-dialog/>

</div>    

