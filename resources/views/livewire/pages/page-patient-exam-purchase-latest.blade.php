@php
  $linked = $refraction_id != null ? "<i class=\"text-primary bi bi-link\"></i>" : '';
@endphp

<div class="col-12">
        <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-4">
          <div class="d-flex align-items-center flex-wrap">
            <h4 class="fw-bold pb-0 pt-0 ps-0 m-0 pe-3">Purchase</h4>
            @if ($this->refraction_id != null)
              <span class="text-primary"><i class="bi bi-link"></i> {{ $this->refraction_id }}</span>
            @endif
          </div>
          <div class="d-flex gap-3">
            <button {!! $this->creating_purchase() !!} class="btn btn-outline-primary">Create New</button>
          </div>
        </div>

        @if (!empty($this->purchase_id))
          <div class="d-flex justify-content-between gap-4">
            <div style="width: 20em;">
              <x-atoms.search w-model="searchItem" placeholder="Search Item Name"/>
            </div>
            <div class="d-flex gap-3">
                @if (!empty($this->searchItem) || $this->list_item)
                    <x-atoms.button w-click="update_list_item" class="btn-outline-primary" icon="bi-x-lg" text="Cancel" style="transition:0ms"/>
                @else
                  <x-atoms.button w-click="update_list_item" class="btn-primary" icon="bi-plus-lg" text="Select Item" style="transition:0ms"/>
                  <button {!! $this->deleting_purchase($purchase_id) !!} class="btn btn-outline-primary"><i class="bi bi-trash"></i></button>
                @endif
            </div>
          </div>

          <div>          
            @if (!empty($this->searchItem) || $this->list_item)     <!-- select an item -->
              <div class="d-flex flex-wrap gap-3 mt-4 mb-4 pt-2">
                <div class="form-check">
                  <input wire:model="category" class="form-check-input" value="all" type="radio" id="all">
                  <label for="all" class="form-check-label">All</label>
                </div>

                @foreach ($categories as $category)
                  <div class="form-check">
                    <input wire:model="category" class="form-check-input" value="{{ $category->id }}" type="radio" id="{{ $category->id }}">
                    <label for="{{ $category->id }}" class="form-check-label">{{ $category->title }}</label>
                  </div>
                @endforeach
              </div>

              <div style="max-height: 40em; overflow-y:auto;">
                <ol class="list-group">  
                  @foreach($items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center">
                            <div class="btn-group">
                              <x-atoms.button w-click="purchase_item({{ $item->id }}, {{ $item->price }}, false)" class="btn-primary btn-sm" style="transition:0ms" icon="bi-plus-lg" title="Purchase Now"/>
                              <x-atoms.button w-click="purchase_item({{ $item->id }}, {{ $item->price }}, true)" class="btn-outline-primary btn-sm" style="transition:0ms" icon="bi-cart" title="Order"/>
                            </div>
                        </div>
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">{{ $item->name }}</div>
                          <small class="text-muted">
                            {{ $item->list_group_item_size_sphere_description }} <br>
                            <span class="text-primary fw-bold">
                              <i class="bi bi-tag-fill"></i>
                              {{ number_format($item->price, 2) }} 
                            </span>
                             | 
                            <span class="{{ $item->quantity < $item->buffer ? 'text-danger' : 'text-primary' }}">
                                {{ $item->quantity }} {{ $item->unit }} left
                            </span>
                          </small>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </ol>
              </div>

              {{ $items->links() }}

            @else    <!-- display latest purchase -->
              
                @if (count($purchase_details) > 0)     <!-- total section -->
                  <div class="mt-4 mb-4 pt-2" x-data="{show_deposit_discount_edit: false}">

                    <div class="row pb-2 mb-2">
                      <div class="col-md-12">
                        <div class="d-flex align-items-end justify-content-between gap-2">
                          <div>
                            {{-- <button @click="show_deposit_discount_edit = ! show_deposit_discount_edit" class="btn btn-sm btn-light text-primary">Edit</button> --}}
                          </div>
                          {{-- <div class="d-flex gap-3">
                            <div class="form-floating">
                                <input wire:model.lazy="deposit" type="number" min="0" step="0.01" class="form-control" id="deposit" placeholder="Deposit" style="width: 9rem;">
                                <label for="deposit">Deposit</label>
                            </div>
                            <div class="form-floating">
                                <input wire:model.lazy="discount" type="number" min="0" step="0.01" class="form-control" id="discount" placeholder="Discount" style="width: 9rem;">
                                <label for="discount">Discount</label>
                            </div>
                          </div> --}}
                          <div class="d-flex justify-content-end flex-wrap gap-4">
                            <div class="text-end">
                              <small class="text-primary opacity-75">DEPOSIT:</small><h3 class="text-secondary fw-bold m-0">₱ {{ number_format($display_purchase_deposit, 2) }}</h3>
                            </div>
                            <div class="text-end">
                                @if ($display_purchase_deposit >= $display_purchase_total)
                                  <small class="text-primary opacity-75">BALANCE:</small><h3 class="text-secondary fw-bold text-muted m-0">₱ 0.00</h3>
                                @else
                                  <small class="text-primary opacity-75">BALANCE:</small><h3 class="text-secondary fw-bold text-muted m-0">₱ {{ number_format($display_purchase_balance, 2) }}</h3>
                                @endif
                            </div>
                            <div class="text-end">
                              <small class="text-primary opacity-75">AMOUNT TO PAY:</small><h3 class="text-primary fw-bold m-0">₱ {{ number_format($display_purchase_total, 2) }}</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
        
                    {{-- <div x-show="show_deposit_discount_edit" @click.outside="show_deposit_discount_edit = false" x-cloak x-transition class="border rounded p-3" style="max-width:400px;">
                      <div class="d-flex gap-3 mb-3">
                          <div class="form-floating">
                              <input wire:model.lazy="deposit" type="number" min="0" step="0.01" class="form-control" id="deposit" placeholder="Deposit">
                              <label for="deposit">Deposit</label>
                          </div>
                          <div class="form-floating">
                              <input wire:model.lazy="discount" type="number" min="0" step="0.01" class="form-control" id="discount" placeholder="Discount">
                              <label for="discount">Discount</label>
                          </div>
                        </div>
                        <div class="text-center">
                          <x-atoms.button w-click="confirm_payment({{ $purchase_total }})" text="Confirm" icon="bi-check-lg" class="btn-primary"/>
                        </div>
                    </div> --}}
                    {{-- @if (!$is_paid) --}}
  
                      <form wire:submit.prevent="update_or_create_payment({{ $display_purchase_total }}, {{ $display_purchase_deposit }})" class="border-top d-flex justify-content-between align-items-center gap-3 flex-wrap pt-3">
                        <div class="d-flex gap-3">
                          <div class="form-floating">
                              <input wire:model.defer="new_deposit" type="number" min="0" step="0.01" class="form-control {{ $is_invalid_deposit }}" id="deposit" placeholder="Deposit" style="width: 7rem;" {{ $btn_disable_deposit }}>
                              <label for="deposit">Deposit</label>
                          </div>
                          <div class="form-floating">
                              <input wire:model.defer="discount" type="number" min="0" step="0.01" class="form-control" id="discount" placeholder="Discount" style="width: 7rem;">
                              <label for="discount">Discount</label>
                          </div>
                          {{-- <div class="form-floating">
                              <input type="text" class="form-control" list="mode_of_payments" style="width: 9em;" {{ $btn_disable_deposit }}>
                              <datalist id="mode_of_payments">
                                @foreach ($from_trait_mode_of_payments as $mode)
                                  <option value="{{ $mode }}">                              
                                @endforeach
                              </datalist>
                              <label>Mode of Payment</label>
                          </div> --}}

                          <div class="form-floating">
                            <input wire:model.defer="payment_mode" class="form-control" type="text" list="mode_of_payment" style="width: 10rem;">
                            <datalist id="mode_of_payment">
                              @foreach ($from_trait_mode_of_payments as $mode)
                                <option value="{{ $mode }}"/>
                              @endforeach
                            </datalist>
                            {{-- <select wire:model.defer="payment_mode" class="form-select" {{ $btn_disable_deposit }}>
                              @foreach ($from_trait_mode_of_payments as $mode)
                                <option value="{{ $mode }}">{{ $mode }}</option>                              
                              @endforeach
                            </select> --}}
                            <label>Mode of Payment</label> 
                          </div>
                        </div>
                        <div class="text-end">
                          <label for="check-paid" class="me-3">
                            <input id="check-paid" wire:model.defer="is_paid" type="checkbox" value="true" class="form-check-input"> 
                            Paid
                          </label>
                          <button class="btn btn-primary" type="submit" {{ $btn_save_purchase_disable }}>{{ $btn_confirm_text }}</button>
                        </div>
                      </form>
                      {{-- @else 
                      <div class="alert alert-primary alert-dismissible fade show" role="alert">
                          Paid
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif --}}



                  </div>
                @endif

                <div class="mt-4">
                  <ol class="list-group">
                    @forelse ($purchase_details as $pd)
                      @php
                        $this->total += ($pd->quantity * $pd->price);
                      @endphp
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                          <div class="d-flex align-items-center gap-2" style="width:7em;">
                              <x-atoms.button w-click="decrement_item({{ $pd->id }}, {{ $pd->order_status }})" class="btn-light btn-sm" icon="bi-dash-lg" style="transition:0ms"/>
                              <h6 class="m-0">{{ $pd->quantity }}</h6>
                              <x-atoms.button w-click="increment_item({{ $pd->id }}, {{ $pd->order_status }})" class="btn-light btn-sm" icon="bi-plus-lg" style="transition:0ms"/>
                          </div>
                          <div class="ms-2 me-auto">
                            <div><span class="badge bg-primary">{{ $pd->current_order_status }}</span> <span class="fw-bold">{{ $pd->item->name }}</span></div>
                            <small class="text-muted">
                              {{ $pd->item->list_group_item_size_sphere_description }} <br>
                              <span class="text-primary fw-bold">
                                  <i class="bi bi-tag-fill"></i>
                                  {{ number_format($pd->price, 2) }}
                              </span>

                              @if (is_null($pd->order_status))
                                | 
                                <span class="tw-bold {{ $pd->item->quantity < $pd->item->buffer ? 'text-danger' : 'text-primary' }}">
                                  {{ $pd->item->quantity }} {{ $pd->item->unit }} left
                                </span>
                              @endif



                            </small><br>
                          </div>
                        </div>
                        <button {!! $this->confirm_purchase_detail_remove($pd->id) !!} class="btn btn-link btn-sm text-danger" style="font-size:1rem" title="Remove"><i class="bi bi-trash"></i></button>
                      </li>
                    @empty
                      <x-atoms.alert text-body="Selected items will be displayed here." icon="bi-info-circle" class="alert-primary"/>
                    @endforelse    
                  </ol>
                </div>

                <x-atoms.display-date :text="$latest_purchase_date"/>

            @endif
          </div>

        @else 
          <div class="py-4 text-center">
              No Data.
          </div>
        @endif
</div>