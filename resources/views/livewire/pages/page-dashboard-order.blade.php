<div class="row">
    <div class="col-12">
        <div class="card card-body pt-3">
            <div class="card-title mb-4 p-0">Patient Orders</div>
            <div class="row g-3">
                @foreach ($from_trait_order_status as $order)
                    <div class="col-6 col-md-3 col-xl-3">
                        <div class="border rounded">
                            <div class="d-flex align-items-center">
                                <div class="card-icon text-primary rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="{{ $order['icon'] }}"></i>
                                </div>
                                <div class="ps-2">
                                    <h3 class="fw-bold m-0">{{ $this->count_order_by_status($order['value']) }}</h3>
                                    <span class="text-truncate text-muted small ps-1">{{ $order['title'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>