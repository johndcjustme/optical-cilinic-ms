<div class="row">
    {{-- Stop trying to control. --}}
    @foreach ($general as $g)
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title">{{ $g['title'] }}</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon text-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="{{ $g['icon'] }}"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $g['value'] }}</h6>
                            {!! $g['span'] !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endforeach


</div>
