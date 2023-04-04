<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">


    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> --}}







    <!-- Vendor CSS Files -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        [x-cloak] { 
            display: none !important;
        }
        
        .spin-me {
            -webkit-animation:spin 0.75s linear infinite;
            -moz-animation:spin 0.75s linear infinite;
            animation:spin 0.75s linear infinite;
        }
        @-moz-keyframes spin { 
            100% { -moz-transform: rotate(360deg); } 
        }
        @-webkit-keyframes spin { 
            100% { -webkit-transform: rotate(360deg); } 
        }
        @keyframes spin { 
            100% {
                -webkit-transform: rotate(360deg); 
                transform:rotate(360deg); 
            }
        }
    </style>

    <script>
        // var confirmMethod, confirmValue; //used in confirm modal

        window.addEventListener('view-in-out-details', event => {
            $('#view-in-out-details').click();
        });

        window.addEventListener('modal-show', event => {
            $('#x-modal').modal('show');
        });

        window.addEventListener('modal-hide', event => {
            $('#x-modal').modal('hide');
        });

        window.addEventListener('confirm-show', event => {
            $('.x-confirm #confirm-title').text(event.detail.title);
            $('.x-confirm #confirm-body').text(event.detail.body);

            $('#' + event.detail.id).modal('show');
        });

        window.addEventListener('confirm-close', event => {
            $('.x-confirm').modal('hide');
            $('.x-confirm-modal').modal('hide');
        });

        window.addEventListener('toast', event => {
            $('#toast-icon').removeClass('bi-check-square-fill bi-x-square-fill text-danger text-primary text-warning bi-info-circle-fill');
            $('#toast-title').removeClass('text-primary text-danger text-warning');

            if (event.detail.type == 'success') {
                $('#toast-icon').addClass('bi-check-square-fill text-primary');
                $('#toast-title').text('Success').addClass('text-primary');
            } 
            if (event.detail.type == 'error') {
                $('#toast-icon').addClass('text-danger bi-x-square-fill');
                $('#toast-title').text('Error').addClass('text-danger')
            }
            if (event.detail.type == 'warning') {
                $('#toast-icon').addClass('text-warning bi-info-circle-fill');
                $('#toast-title').text('Warning').addClass('text-warning')
            }

            $('#toast-body').text(event.detail.body);
            $('#toast').toast('show');
        });

        // function confirmModal(confirmMethod, title, body) {
        //     this.confirmMethod = confirmMethod;
        //     $('.x-confirm-modal #confirm-title').text(title);
        //     $('.x-confirm-modal #confirm-body').text(body);
        //     $('.x-confirm-modal').modal('show');
        // }

    </script>

    @livewireStyles
</head>

<body>

{{-- 
    @auth
        <x-organisms.header-index/>
        @include('components.organisms.side-navigation-index', ['categorized' => true])
    @endauth 
--}}

    {{-- @auth
        @livewire('pages.main')
    @endauth --}}

    @yield('content')

    {{-- 
    <main id="main" class="main">
        <section class="section" style="max-width:1500px; margin-right:auto; margin-left:auto">
            {{ $slot ?? null }}
        </section>
    </main>
    --}}

    <x-atoms.scroll-top/>
    <x-organisms.modal-index/>
    <x-organisms.toast/>

    <!-- Vendor JS Files -->
    <script src="vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/js/app.js"></script>


    @livewireScripts
    @livewireChartsScripts

    <script src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>


