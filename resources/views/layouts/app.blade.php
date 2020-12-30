<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
    @yield('css')
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-50">
    {{ $slot }}


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
    <x-livewire-alert::scripts />
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('js')

</body>

</html>
