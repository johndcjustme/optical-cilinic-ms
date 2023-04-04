@php
  $categories = [
      [
        'title' => 'Dashboard',
        'items' => [
          [
            'title'     => 'Dashboard',
            'icon'      => 'grid',
            'link'      => 'dashboard',  
          ],
        ]
      ], [
        'title' => 'Payment',
        'items' => [
          [
            'title'     => 'Payments',
            'icon'      => 'credit-card-2-front',
            'link'      => 'payments',
          ]
        ]
      ], [
        'title' => 'Patient',
        'items' => [
          [
            'title'     => 'Patients',
            'icon'      => 'people',
            'link'      => 'patients',  
          ], [
            'title'     => 'Orders',
            'icon'      => 'cart',
            'link'      => 'orders',  
          ], [
            'title'     => 'Appointments',
            'icon'      => 'calendar-check',
            'link'      => 'appointments',  
          ],
        ]
      ], [
        'title' => 'Inventory',
        'items' => [
          [
            'title'     => 'Inventory',
            'icon'      => 'box',
            'link'      => 'inventory',  
          ], [
            'title'     => 'Reorder',
            'icon'      => 'cart',
            'link'      => 'reorder',  
          ], [
            'title'     => 'Suppliers',
            'icon'      => 'truck',
            'link'      => 'suppliers',  
          ],
        ]
      ], [
        'title' => 'Others',
        'items' => [
          [
            'title'     => 'Reports',
            'icon'      => 'graph-up-arrow',
            'link'      => 'reports',  
          ], [
            'title'     => 'Users',
            'icon'      => 'people',
            'link'      => 'users',  
          ],
        ]
      ]
  ];


  $request = new \Request;
  $active = 'active';
@endphp


<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      @foreach ($categories as $category)
      <!-- category title -->
        @if ($categorized)
          <li class="nav-heading">{{ $category['title'] }}</li>
        @endif

        <!-- category contents -->
        @foreach ($category['items'] as $item)
          @php 
              $active = $request::is($item['link']) || $request::is($item['link'] . '/*') ? 'active' : null;
          @endphp
          <li class="nav-item">
            <a class="nav-link {{ $active }}" href="/{{ $item['link'] }}">
              <i class="bi bi-{{ $item['icon'] }}"></i>
              <span>{{ $item['title'] }}</span>
            </a>
          </li>  
        @endforeach
      @endforeach

      {{-- @foreach ($items as $item)
      
        @php 
            $request = new \Request;
            $active = $request::is($item['link']) || $request::is($item['link'] . '/*') ? 'active' : null;
        @endphp
        
        <li class="nav-item">
          <a class="nav-link {{ $active }}" href="/{{ $item['link'] }}">
            <i class="bi bi-{{ $item['icon'] }}"></i>
            <span>{{ $item['title'] }}</span>
          </a>
        </li>

      @endforeach --}}

    </ul>
</aside>
