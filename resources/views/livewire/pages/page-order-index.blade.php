<x-layouts.main-content-index>

    {{-- The Master doesn't talk, he acts. --}}

    <x-layouts.main-content-nav page-title="Orders"/>
    @include('livewire.pages.includes.options-orders-index')

    <x-layouts.main-content-content>    
        <div class="card card-body">
            <ul class="nav nav-tabs my-4">
                @foreach ($from_trait_order_status as $status)
                    @php
                        $active = $current_order_status == $status['value'] ? 'active' : '';
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ $active }}" 
                            wire:click.prevent="$set('current_order_status', {{ $status['value'] }})" 
                            href="#">{{ $status['title'] . $this->count_order_status($status['value']) }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <br>
            <h5>Lens</h5>
            <div class="table-responsive">
                <x-organisms.table-index>
                    <x-slot name="thead">
                        <x-organisms.table-th-checkbox/>
                        <x-organisms.table-th text="Refraction ID" style="width:12em"/>
                        <x-organisms.table-th text="Particulars"/>
                        <x-organisms.table-th text="Qty" style="width:4em"/>
                        <x-organisms.table-th text="Patient" style="width:18em;"/>
                        <x-organisms.table-th text="Date Created" style="width:10em"/>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach($orders as $order)
                            <!-- 1 is equal to lens -->
                            @if ($order->item->category_id === 1)
                                <tr>
                                    <x-organisms.table-td-checkbox :value="$order->id" w-model="selected_items"/>
                                    <x-organisms.table-td :text="$order->purchase->refraction_id ?? ''" class="text-primary"/>
                                    <x-organisms.table-th :text="$order->item->name"/>
                                    <x-organisms.table-td :text="$order->quantity"/>
                                        <x-organisms.table-td :text="$order->purchase->patient->name ?? ''"/>
                                    <x-organisms.table-td :text="$order->created_at"/>
                                </tr>
                            @endif
                        @endforeach
                    </x-slot>
                </x-organisms.table-index>
            </div>
            <br>
            <br>
            <h5>Frame</h5>
            <div class="table-responsive">
                <x-organisms.table-index class="table-responsive">
                    <x-slot name="thead">
                        <x-organisms.table-th-checkbox/>
                        <x-organisms.table-th text="Code" style="width:12em"/>
                        <x-organisms.table-th text="Particulars"/>
                        <x-organisms.table-th text="Size" style="width:8em;"/>
                        <x-organisms.table-th text="Qty" style="width:4em;"/>
                        <x-organisms.table-th text="Patient" style="width:18em;"/>
                        <x-organisms.table-th text="Date Created" style="width:10em;"/>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach($orders as $order)
                            <!-- 2 is equal to frame -->
                            @if ($order->item->category_id === 2) 
                                <tr>
                                    <x-organisms.table-td-checkbox :value="$order->id" w-model="selected_items"/>
                                    <x-organisms.table-td scope="row" :text="$order->item->code" class="text-primary"/>
                                    <x-organisms.table-th scope="row" :text="$order->item->name"/>
                                    <x-organisms.table-td :text="$order->item->size"/>
                                    <x-organisms.table-td :text="$order->quantity"/>
                                    <x-organisms.table-td :text="$order->purchase->patient->name ?? ''"/>
                                    <x-organisms.table-td :text="$order->created_at"/>
                                </tr>
                            @endif
                        @endforeach
                    </x-slot>
                </x-organisms.table-index>                    
            </div>
            {{-- <x-organisms.table-index>
                <x-slot name="thead">
                    <x-organisms.table-th-checkbox/>
                    <x-organisms.table-th text="#" style="width: 2em;"/>
                    <x-organisms.table-th text="Order Name"/>
                    <x-organisms.table-th text="Size"/>
                    <x-organisms.table-th text="Quantity"/>
                    <x-organisms.table-th text="Supplier"/>
                    <x-organisms.table-th text="Owner"/>
                    <x-organisms.table-th text="Date Created"/>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($orders as $key => $order)
                        <tr>
                            <x-organisms.table-td-checkbox :value="$order->id" w-model="selected_items"/>
                            <x-organisms.table-td :desc="$orders->firstItem() + $key"/>
                            <x-organisms.table-th :text="$order->name" :desc="$order->description"/>
                            <x-organisms.table-td :text="$order->size"/>
                            <x-organisms.table-td :text="$order->quantity"/>
                            <x-organisms.table-td :text="$order->supplier->name ?? ''" :desc="$order->supplier->branch ?? ''"/>
                            <x-organisms.table-th :text="$order->patient->name" :desc="$order->patient->mobile_1"/>
                            <x-organisms.table-td :text="$order->created_at"/>
                        </tr>
                    @empty
                        <tr>
                            <x-organisms.table-td colspan="9" class="text-center" text="Empty."/> 
                        </tr> 
                    @endforelse
                </x-slot>
            </x-organisms.table-index> --}}
        </div>
    </x-layouts.main-content-content>    
</x-layouts.main-content-index>    

