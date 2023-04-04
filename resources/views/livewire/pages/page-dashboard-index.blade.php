<x-layouts.main-content-index class="section dashboard">
    <x-layouts.main-content-nav page-title="Dashboard"/>


    <div class="row mt-4">
        <div class="col-lg-8">

            {{-- <div class="row">
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
    
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
    
                    <div class="card-body">
                        <h5 class="card-title">Sales <span>| Today</span></h5>
    
                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>145</h6>
                            <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
    
                        </div>
                        </div>
                    </div>
    
                    </div>
                </div>

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
    
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
    
                    <div class="card-body">
                        <h5 class="card-title">Sales <span>| Today</span></h5>
    
                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>145</h6>
                            <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
    
                        </div>
                        </div>
                    </div>
    
                    </div>
                </div>

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
    
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
    
                    <div class="card-body">
                        <h5 class="card-title">Sales <span>| Today</span></h5>
    
                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>145</h6>
                            <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
    
                        </div>
                        </div>
                    </div>
    
                    </div>
                </div>

            </div> --}}

            @livewire('pages.page-dashboard-general')



            @livewire('pages.page-dashboard-chart-patient')
            {{-- @livewire('pages.page-dashboard-top-selling') --}}
            @livewire('pages.page-dashboard-order')
            @livewire('pages.page-dashboard-reorders')



        </div>
        <div class="col-lg-4">
            @livewire('pages.page-dashboard-inventory')
            @role('admin')
                @livewire('pages.page-dashboard-user-activity')
            @endrole

            {{-- @livewire('pages.page-dashboard-patient-orders') --}}
        </div>

    </div>


</x-layouts.main-content-index>