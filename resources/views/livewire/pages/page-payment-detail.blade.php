<x-layouts.main-content-content>
   
    <x-organisms.about-patient :patient="$patient"/>

    <div class="row g-3 mb-4">
        @foreach ($purchases as $purchase)
            @php
                $total = $purchase->purchase_details->sum('price') - $purchase->discount;
                $balance = $total - $purchase->deposit;
                $deposit = $purchase->deposit;
                $is_disabled = is_null($deposit) ? 'disabled' : '';
            @endphp
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-4">
                            <div>
                                <h5 class="p-0 mb-0 text-danger">
                                    @if (is_null($deposit))
                                        PAID
                                    @else 
                                        BAL: ₱ {{ number_format($balance, 2)  }} 
                                    @endif
                                </h5>
                                <small class="text-primary">Amount to Pay: ₱ {{ number_format($total, 2) }}</small>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-primary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" {{ $is_disabled }}>Add Payment <i class="bi bi-caret-down-fill"></i></button>
                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuClickableOutside">
                                        <form wire:submit.prevent="add_payment({{ $purchase->id }}, {{ $balance }})">
                                            <div class="row g-2">
                                                <input wire:model.defer="payment.amount" type="text" class="form-control form-control-sm" placeholder="Enter Amount" required>
                                                <input wire:model.defer="payment.date" type="date" class="form-control form-control-sm">
                                                <input wire:model.defer="payment.mode" type="text" class="form-control form-control-sm" list="mode_of_payments">
                                                <datalist id="mode_of_payments">
                                                    @foreach ($from_trait_mode_of_payments as $mode)
                                                        <option value="{{ $mode }}">
                                                    @endforeach
                                                </datalist>
                                                @if ($balance != 0)
                                                    <x-atoms.button type="submit" type="submit" class="btn btn-primary btn-sm" text="Add"/>
                                                @endif
                                            </div>
                                            @if (!is_null($deposit))
                                                <div class="text-center w-full font-sm text-muted">or</div>
                                                <button type="submit" {!! $this->confirm_paid($purchase->id, $balance) !!} class="btn btn-sm btn-outline-primary w-100">Paid</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <x-organisms.table-index>
                            <x-slot name="thead">
                                <x-organisms.table-th text="Amount"/>
                                <x-organisms.table-th text="Date"/>
                                <x-organisms.table-th/>
                                <x-organisms.table-th style="width: 2rem"/> 
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($purchase->payments as $payment)
                                    <tr>
                                        <x-organisms.table-th scope="row" :text="number_format($payment->amount, 2)"/>
                                        <x-organisms.table-td :text="$payment->created_at"/>
                                        <x-organisms.table-td :text="$payment->payment_mode"/>
                                        <x-organisms.table-td class="text-end">
                                            <button {!! $this->deleting_payment($payment->id, $purchase->id, $payment->amount, $total) !!} class="btn btn-sm btn-link"><i class="bi bi-trash"></i></button>
                                        </x-organisms.table-td>
                                    </tr>
                                @empty 
                                    <tr>
                                        <x-organisms.table-td text="No data." class="text-center" colspan="3"/>
                                    </tr>
                                @endforelse
                            </x-slot>
                        </x-organisms.table-index>
                        <small class="text-muted">{{ $purchase->created_at }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.main-content-content>
