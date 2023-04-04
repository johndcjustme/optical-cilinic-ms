<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        {{-- <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="vendor/simple-datatables/style.css" rel="stylesheet"> --}}
        
        <link rel="stylesheet" href="/css/app.css">
        

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}


        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body>
        <main>
            <div class="container">
                {{ $slot }}
            </div>
        </main>
        {{-- <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div> --}}
    </body>
</html>
