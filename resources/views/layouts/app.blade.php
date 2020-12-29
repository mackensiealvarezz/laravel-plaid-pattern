<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')

    @if (getenv('APP_ENV') === 'local')
    <script id="__bs_script__">
        //<![CDATA[
    document.write("<script async src='http://HOST:3001/browser-sync/browser-sync-client.js?v=2.26.13'><\/script>".replace("HOST", location.hostname));
//]]>
    </script>
    @endif
</body>

</html>
