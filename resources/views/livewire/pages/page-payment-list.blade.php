<div>
    @include('livewire.pages.includes.title-link-payment')

    @if (empty($this->detail_id))
        @include('livewire.pages.includes.options-payment-list')

        <x-layouts.main-content-content>
            <x-organisms.table-index with-card>
                <x-slot name="header">
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ $with_balance ? 'active' : '' }}" wire:click.prevent="$set('with_balance', true)" href="#">Unpaid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ !$with_balance ? 'active' : '' }}" wire:click.prevent="$set('with_balance', false)" href="#">Paid</a>
                        </li>
                    </ul>
                </x-slot>
                <x-slot name="thead">
                    <x-organisms.table-th style="width:8em;"/>
                    <x-organisms.table-th text="Patient Name"/>
                    <x-organisms.table-th text="Balance"/>
                </x-slot>
                <x-slot name="tbody">
                    @php
                        $i = 1;
                    @endphp
                    @forelse ($purchases as $purchase)
                        @if ($with_balance)
                            @if (!is_null($purchase->deposit))
                                <tr>
                                    <x-organisms.table-td>
                                        <x-atoms.button w-click="$set('detail_id', {{ $purchase->patient->id }})" class="btn-link btn-sm">View Detail</x-atoms.button>
                                    </x-organisms.table-td>
                                    <x-organisms.table-td :text="$purchase->patient->name"/>
                                    <x-organisms.table-td text="Unpaid"/>
                                </tr>
                            @endif
                        @else 
                            @if (is_null($purchase->deposit))
                                <tr>
                                    <x-organisms.table-td>
                                        <x-atoms.button w-click="$set('detail_id', {{ $purchase->patient->id }})" class="btn-link btn-sm">View Detail</x-atoms.button>
                                    </x-organisms.table-td>
                                    <x-organisms.table-td :text="$purchase->patient->name"/>
                                    <x-organisms.table-td text="Paid"/>
                                </tr>
                            @endif
                        @endif
                    @empty
                        <tr>
                            <x-organisms.table-td text="No Data." class="text-center" icon="i-info-circle" colspan="4"/>
                        </tr>
                    @endforelse
                </x-slot>
            </x-organisms.table-index>  
        </x-layouts.main-content-content>

    @else
        @livewire('pages.page-payment-detail', ['patient_id' => $detail_id])
    @endif

</div>