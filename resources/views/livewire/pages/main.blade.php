@php
    $categorized = true;
    $request = new \Request;

    $categories = [
        [
          'title' => 'Dashboard',
          'items' => [
            [
              'title'   => 'Dashboard',
              'icon'    => 'grid',
              'link'    => 'dashboard',
              'page'    => 'pages.page-dashboard-index'  
            ],
          ]
        ], [
          'title' => 'Payment',
          'items' => [
            [
              'title'   => 'Payments',
              'icon'    => 'credit-card-2-front',
              'link'    => 'payments',
              'page'    => 'pages.page-payment-index'
            ]
          ]
        ], [
          'title' => 'Patient',
          'items' => [
            [
              'title'   => 'Patients',
              'icon'    => 'people',
              'link'    => 'patients',
              'page'    => 'pages.page-patient-index'  
            ], [
              'title'   => 'Orders',
              'icon'    => 'cart',
              'link'    => 'orders',
              'page'    => 'pages.page-order-index'  
            ], [
              'title'   => 'Appointments',
              'icon'    => 'calendar-check',
              'link'    => 'appointments',
              'page'    => 'pages.page-appointment-index'  
            ],
          ]
        ], [
          'title' => 'Inventory',
          'items' => [
            [
              'title'   => 'Inventory',
              'icon'    => 'box',
              'link'    => 'inventory',
              'page'    => 'pages.page-inventory-index'  
            ], [
              'title'   => 'Reorders',
              'icon'    => 'cart',
              'link'    => 'reorder',
              'page'    => 'pages.page-reorder-index'  
            ], [
              'title'   => 'Suppliers',
              'icon'    => 'truck',
              'link'    => 'suppliers',
              'page'    => 'pages.page-supplier-index'  
            ],
          ]
        ], [
          'title' => 'Others',
          'items' => [
            // [
            //   'title'   => 'Reports',
            //   'icon'    => 'graph-up-arrow',
            //   'link'    => 'reports',
            //   'page'    => 'pages.page-report-index'  
            // ], 
            [
              'title'   => 'Users',
              'icon'    => 'people',
              'link'    => 'users',
              'page'    => 'pages.page-user-index',
            ], 
            // [
            //   'title'   => 'Settings',
            //   'icon'    => 'gear-wide',
            //   'link'    => 'settings',
            //   'page'    => 'pages.page-settings-index',
            // ]
          ]
        ]
    ];
@endphp


<div>
    <!-- header -->
    <x-organisms.header-index :categories="$categories"/>
    <!-- end header -->

    <!-- sidebar -->
    {{-- <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @foreach ($categories as $category)
            <!-- category title, set "categorized" variable to true -->
              @if ($categorized)
                <li class="nav-heading">{{ $category['title'] }}</li>
              @endif
              <!-- category contents -->
              @foreach ($category['items'] as $item)
                <li class="nav-item">
                  <a wire:click.prevent="$set('page', '{{ $item['link'] }}')" class="nav-link {{ $this->is_active($item['link']) }}" href="#">
                    <i class="bi bi-{{ $item['icon'] }}"></i>
                    <span>{{ $item['title'] }}</span>
                  </a>
                </li>  
              @endforeach
              <!-- end category contents -->
            @endforeach
            <!-- end category title -->
        </ul>
    </aside> --}}
    <!-- end sidebar -->

    <!-- main -->
    <main class="main" id="main">
        <div class="section" style="max-width:1500px; margin-right:auto; margin-left:auto">
            @switch($this->page)
              @case('dashboard')    @livewire('pages.page-dashboard-index') @break
              @case('payments')     @livewire('pages.page-payment-index') @break
              @case('patients')     @livewire('pages.page-patient-index') @break
              @case('orders')       @livewire('pages.page-order-index') @break
              @case('appointments') @livewire('pages.page-appointment-index') @break
              @case('inventory')    @livewire('pages.page-inventory-index') @break
              @case('reorder')      @livewire('pages.page-reorder-index') @break
              @case('suppliers')    @livewire('pages.page-supplier-index') @break
              {{-- @case('reports')      @livewire('pages.page-report-index') @break --}}
              @case('users')        @livewire('pages.page-users-index') @break
              @case('profile')      @livewire('pages.page-profile-index') @break
              @case('settings')     @livewire('pages.page-settings-index') @break
              @default              @livewire('pages.page-empty') 
            @endswitch
        </div>
    </main>
    <!-- end main -->
</div>

