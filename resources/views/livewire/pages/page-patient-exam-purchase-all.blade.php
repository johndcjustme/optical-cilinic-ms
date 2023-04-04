@foreach ($purchases as $purchase)
@php 
    $purchase_total = 0;
    foreach($purchase_details2->where('purchase_id', $purchase->id)->get() as $here)  {
      $purchase_total += $here->quantity * $here->price;
    }
@endphp

<div class="card">
<div class="card-body">
  
  <div class="row py-2 mb-2 mt-3">
    <div class="col-md-12">
      <div class="d-flex align-items-end justify-content-between gap-2">
        <div>
          <x-atoms.button w-click="confirm_delete_purchase({{ $purchase->id }})" class="btn-outline-primary" icon="bi-trash"/>
        </div>
        <div class="d-flex justify-content-end flex-wrap gap-4">
          <div class="text-end">
            <small class="text-primary opacity-75">BALANCE:</small><h3 class="text-primary text-muted m-0">₱ 0.00</h3>
          </div>
          <div class="text-end">
            <small class="text-primary opacity-75">TOTAL:</small><h3 class="text-primary m-0">₱ {{ number_format($purchase_total, 2) }}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>


  <ol class="list-group">
    @forelse ($purchase_details2->where('purchase_id', $purchase->id)->get() as $pd)
      <li class="list-group-item d-flex justify-content-between align-items-center"> 
        <div class="d-flex align-items-center gap-2">
          <div class="d-flex align-items-center gap-2" style="width:7em;">
              <x-atoms.button w-click="decrement_item({{ $pd->id }})" class="btn-light btn-sm" icon="bi-chevron-left" style="transition:0ms"/>
              <h6 class="m-0">{{ $pd->quantity }}</h6>
              <x-atoms.button w-click="increment_item({{ $pd->id }})" class="btn-light btn-sm" icon="bi-chevron-right" style="transition:0ms"/>
          </div>
          <div class="ms-2 me-auto">
            <div class="fw-bold">{{ $pd->item->name }}</div>
            <small class="text-muted">SIZE: {{ $pd->item->size }} {{ !empty($pd->item->sphere) ? ' | ' . $pd->item->sphere : '' }}</small><br>
            <small class="text-muted">{{ $pd->item->description }}</small><br>
            <small class="text-primary tw-bold">
              <span>
                <i class="bi bi-tag-fill"></i>
                {{ number_format($pd->price, 2) }} 
              </span>
              | 
              <span class="{{ $pd->item->quantity < $pd->item->buffer ? 'text-danger' : '' }}">
                {{ $pd->item->quantity }} {{ $pd->item->unit }} left</small>
              </span>
          </div>
        </div>
        <a wire:click.prevent="purchase_detail_remove({{ $pd->id }})" class="btn btn-link btn-sm text-danger" style="font-size:1rem" title="Remove"><i class="bi bi-trash"></i></a>
      </li>
    @empty
      <x-atoms.alert text-body="This purchase has no items selected." icon="bi-info-circle" class="alert-primary"/>
    @endforelse    

  </ol>

  <x-atoms.display-date :text="$purchase->created_at"/>

</div>
</div>



@endforeach