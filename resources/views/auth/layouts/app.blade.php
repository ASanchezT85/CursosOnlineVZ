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
    <link href="{{ asset('vendor/themify-icons/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <div class="preloader">
            <img src="{{ asset('images/preloader.svg') }}" alt="Pre-loader">
        </div>
        <section class="p-0 d-flex align-items-center">
            <div class="container-fluid">
                <div class="row">
                    <!-- left -->
                    <div class="col-12 col-md-5 col-lg-4 d-md-flex align-items-center bg-grad h-sm-100-vh">
                        <div class="w-100 p-3 p-lg-5 all-text-white">
                            <div class="justify-content-center align-self-center text-center">
                                <a href="{{ route('welcome') }}">
                                    <img src="{{ asset('images/logo-4.png') }}" alt="{{ config('app.name', 'Laravel') }}" width="200">
                                </a>
                            </div>
                            <h3 class="font-weight-light">{{ __('We connect you with the world largest community') }}.</h3>
                            <ul class="list-group list-group-borderless mt-4">
                                <li class="list-group-item text-white">
                                    {{ __('Connect with your community via Admuni') }}.
                                </li>
                                <li class="list-group-item text-white">
                                    {{ __('Discover the best experience with fellowship') }}.
                                </li>
                                    {{ __('Create your wishlist and enjoy to best experience') }}.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="col-12 col-md-7 col-xl-8 mx-auto my-5">
                        <div class="row h-100">
                            <div class="col-12 col-md-10 col-lg-5 text-left mx-auto d-flex align-items-center">
                                @yield('content')                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>     
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery-3.4.0.js') }}"></script>    
    <script src="{{ asset('vendor/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/functions.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    
</body>
</html>