@php
    $add_to_inventory = false;

    if (count($from_trait_reorder_status) == $current_reorder_status) 
        $add_to_inventory = true;
        
@endphp

<x-layouts.main-content-index>

    <x-layouts.main-content-nav page-title="Reorder"/>

    @include('livewire.pages.includes.options-reorders-index')

    <x-layouts.main-content-content>
        <x-organisms.table-index with-card>
            <x-slot name="header">
                <ul class="nav nav-tabs mb-4">
                    @foreach ($from_trait_reorder_status as $status)
                        @php
                            $active = $current_reorder_status == $status['value'] ? 'active' : '';
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ $active }}" 
                                wire:click.prevent="$set('current_reorder_status', {{ $status['value'] }})" 
                                href="#">{{ $this->count_reorder_status($status['title'], $status['value']) }}</a>
                        </li>
                    @endforeach
                </ul>
            </x-slot>
            <x-slot name="thead">
                <x-organisms.table-th-checkbox/>
                <x-organisms.table-th text="#" style="width:2em"/>
                <x-organisms.table-th text="Code"/>
                <x-organisms.table-th text="Particulars"/>
                <x-organisms.table-th text="Size"/>
                <x-organisms.table-th text="Unit"/>
                <x-organisms.table-th text="Supplier"/>
                <x-organisms.table-th text="Quantity" class="d-flex justify-content-center"/>
                @if ($add_to_inventory)
                    <x-organisms.table-th/>
                @endif
            </x-slot>
            <x-slot name="tbody">

                @forelse ($reorders as $key => $order)
                    <tr>
                        <x-organisms.table-td-checkbox :value="$order->id" w-model="selected_items"/>
                        <x-organisms.table-td :desc="$reorders->firstItem() + $key"/>
                        <x-organisms.table-td :text="$order->item->code"/>
                        <x-organisms.table-th :text="$order->item->name" :desc="$order->item->description"/>
                        <x-organisms.table-td :text="$order->item->size"/>
                        <x-organisms.table-td :text="$order->item->unit"/>
                        <x-organisms.table-td :text="$order->item->supplier->name" :desc="$order->item->supplier->branch"/>
                        <x-organisms.table-td :text="$order->quantity" class="text-center"/>
                        @if ($add_to_inventory)
                            <x-organisms.table-td class="text-end">
                                <x-atoms.button onclick="if(confirm('{{ $order->quantity }} stock(s) will be added to the selected item. Confirm?')) Livewire.emit('add_to_inventory', {{ $order->item_id }}, {{ $order->quantity }});" class="btn btn-sm btn-outline-primary">Add to Inventory <i class="bi bi-arrow-right"></i></x-atoms.button>
                            </x-organisms.table-td>
                        @endif
                    </tr>
                @empty
                    @php
                        $colspan = 7;
                        if ($add_to_inventory) $colspan = 8;
                    @endphp
                    <tr>
                        <x-organisms.table-td colspan="{{ $colspan }}" class="text-center" text="No data."/> 
                    </tr>
                @endforelse

            </x-slot>
        </x-organisms.table-index>
    </x-layouts.main-content-content>
</x-layouts.main-content-index>


