<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WDR</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    {{-- Style --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- css.gg -->
    <link href='https://css.gg/css' rel='stylesheet'>

    <!-- UNPKG -->
    <link href='https://unpkg.com/css.gg/icons/all.css' rel='stylesheet'>

    <!-- JSDelivr -->
    <link href='https://cdn.jsdelivr.net/npm/css.gg/icons/all.css' rel='stylesheet'>
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>