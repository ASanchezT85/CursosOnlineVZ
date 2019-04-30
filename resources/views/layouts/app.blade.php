<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/ico.ico') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/themify-icons/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fancybox/dist/jquery.fancybox.css') }}" rel="stylesheet">
    @stack('css')

</head>
<body>
    <div id="app">
        <div class="preloader">
            <img src="{{ asset('images/preloader.svg') }}" alt="Pre-loader">
        </div>
        @include('patrials.navBar2')        
        <main>
            @yield('jumbotron')
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery-3.4.0.js') }}"></script>    
    <script src="{{ asset('vendor/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/fancybox/dist/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('vendor/functions.js') }}"></script>

    @stack('scripts')
    
    <script src="{{ mix('js/app.js') }}"></script>
    
</body>
</html>
