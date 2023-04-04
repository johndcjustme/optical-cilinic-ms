<div class="col-md-12 col-xl-7">
    <div class="card card-body" class="overflow-x-auto">
        <div class="d-flex align-items-center gap-3 my-4 pb-4 border-bottom">
            <h4 class="fw-bold pb-0 pt-0 ps-0 m-0 pe-3">Ordered Items</h4>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <div class="dropdown">
                    <button type="button" class="btn btn-link p-0 text-decoration-none fw-bold" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
                        <i class="bi bi-plus"></i> Lens Orders
                    </button>
                    <ul class="dropdown-menu p-3" style="width:20rem;">
                        <form wire:submit.prevent="create_lens_order" class="row g-2">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input wire:model.defer="order_lens.refraction_id" type="text" class="form-control" placeholder="Ref ID" required>
                                    <label>Exam Reference ID</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input wire:model.defer="order_lens.particular" type="text" class="form-control" placeholder="Particular" required>
                                    <label>Particulars</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input wire:model.defer="order_lens.quantity" type="number" min="1" class="form-control" placeholder="Quantity" required>
                                    <label>Quantity</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input wire:model.defer="order_lens.price" type="text" class="form-control" placeholder="Price">
                                    <label>Price</label>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button {!! $this->creating_lens_order() !!} type="submit" class="btn btn-sm btn-primary w-100">Save Order <i class="bi bi-check"></i></button> 
                            </div>
                        </form>
                    </ul>
                </div>

                @if (count($lens_orders) > 0)
                    <div class="table-responsive">
                        <x-organisms.table-index>
                            <x-slot name="thead">
                                <x-organisms.table-th text="Refraction ID"/>
                                <x-organisms.table-th text="Particulars"/>
                                <x-organisms.table-th text="Qty" style="width:4em"/>
                                <x-organisms.table-th text="Price" style="width:7em"/>
                                <x-organisms.table-th text="Sub Total" style="width:8em"/>
                                <x-organisms.table-th text="Status" style="width:8em"/>
                                <x-organisms.table-th style="width:3em;"/>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach($lens_orders as $order)
                                    @php
                                        if (!is_null($order->price)) {
                                            $subtotal = $order->quantity * $order->price;
                                            $total += $subtotal;
                                        }
                                    @endphp
                                    <tr>
                                        <x-organisms.table-td :text="$order->refraction_id" class="text-primary"/>
                                        <x-organisms.table-th :text="$order->name"/>
                                        <x-organisms.table-td :text="$order->quantity"/>
                                        <x-organisms.table-td :text="$order->price"/>
                                        <x-organisms.table-td/>
                                        <x-organisms.table-td :text="$order->current_status"/>
                                        <x-organisms.table-td class="text-end">
                                            <button {!! $this->deleting_order($order->id) !!} class="btn btn-sm btn-link"><i class="bi bi-trash text-success"></i></button>
                                        </x-organisms.table-td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.table-index>
                    </div>
                @else
                    <div class="text-center mb-3">
                        No Data.
                    </div>
                @endif

            </div>
            <div class="col-12 mt-3">
                <div class="dropdown">
                    <button type="button" class="btn btn-link p-0 text-decoration-none fw-bold" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
                        <i class="bi bi-plus"></i> Frame Orders
                    </button>
                    <ul class="dropdown-menu p-3" style="width:20rem;">
                        <form wire:submit.prevent="create_frame_order" class="row g-2">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input wire:model.defer="order_frame.code" type="text" class="form-control" placeholder="Code">
                                    <label>Code</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input wire:model.defer="order_frame.type" list="frame-type" type="text" class="form-control" placeholder="Type">
                                    <label>Type</label>
                                </div>
                                <datalist id="frame-type">
                                    <option value="Fullrim">
                                    <option value="Half Frame">
                                </datalist>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input wire:model.defer="order_frame.particular" type="text" class="form-control" placeholder="Particular">
                                    <label>Particulars</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input wire:model.defer="order_frame.size" type="text" class="form-control" placeholder="Size">
                                    <label>Size</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input wire:model.defer="order_frame.quantity" type="number" min="1" class="form-control" placeholder="Quantity">
                                    <label>Quantity</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input wire:model.defer="order_frame.price" type="text" class="form-control" placeholder="Price">
                                    <label>Price</label>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button {!! $this->creating_frame_order() !!} type="submit" class="btn btn-sm btn-primary w-100">Save Order <i class="bi bi-check"></i></button> 
                            </div>
                        </form>
                    </ul>
                </div>


                @if (count($frame_orders) > 0)
                    <div class="table-responsive">
                        <x-organisms.table-index class="table-responsive">
                            <x-slot name="thead">
                                <x-organisms.table-th text="Code"/>
                                <x-organisms.table-th text="Particulars"/>
                                <x-organisms.table-th text="Size"/>
                                <x-organisms.table-th text="Qty" style="width:4em;"/>
                                <x-organisms.table-th text="Price" style="width:7em;"/>
                                <x-organisms.table-th text="Sub Total" style="width:8em;"/>
                                <x-organisms.table-th text="Status" style="width:8em;"/>
                                <x-organisms.table-th style="width:3em;"/>
                            </x-slot>
                            <x-slot name="tbody">
                                @php
                                    if (!is_null($order->price)) {
                                        $subtotal = $order->quantity * $order->price;
                                        $total += $subtotal;
                                    }
                                @endphp
                                @foreach($frame_orders as $order)
                                    <tr>
                                        <x-organisms.table-td scope="row" :text="$order->code" class="text-primary"/>
                                        <x-organisms.table-td scope="row" :text="$order->name"/>
                                        <x-organisms.table-td :text="$order->size"/>
                                        <x-organisms.table-td :text="$order->quantity"/>
                                        <x-organisms.table-td :text="$order->price"/>
                                        <x-organisms.table-td/>
                                        <x-organisms.table-td :text="$order->current_status"/>
                                        <x-organisms.table-td class="text-end">
                                            <button {!! $this->deleting_order($order->id) !!} class="btn btn-sm btn-link"><i class="bi bi-trash text-success"></i></button>
                                        </x-organisms.table-td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.table-index>
                    </div>
                @else
                    <div class="text-center">
                        No Data.
                    </div>
                @endif
            </div>

            <h5>Total: {{ $total }}</h5>
            
            <div class="row g-3">
                <div class="col-3">
                    <div class="form-floating">
                        <input wire:model.defer="" type="text" class="form-control" placeholder="Deposit">
                        <label>Deposit</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-floating">
                        <input wire:model.defer="" type="text" class="form-control" placeholder="Discount">
                        <label>Discount</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>