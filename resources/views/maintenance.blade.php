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

    <!-- =======================
    maintenance mode -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 font-weight-bold text-grad">
                        {{ __('Algo emocionante se acerca en tu camino!') }}
                    </h1>
                    <p>{{ __('A complete package; Our company is dedicated to your training. We are a family and we want you to be part of it') }}.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto text-center">
                    <div class="skill skill-text-in skill-grad mb-0 mb-md-4">
                        <div class="skill-wrap">
                            <!-- Skill item -->
                            <div class="skill-item">
                                <p>Launch Progress</p>
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="3s" data-wow-delay="1s" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width:85%"><span class="skill-percent">85%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- social icons -->
                    <ul class="social-icons round light si-colored-bg-on-hover text-center mt-5">
                        <li class="social-icons-item social-facebook">
                            <a class="social-icons-link" href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="social-icons-item social-instagram">
                            <a class="social-icons-link" href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="social-icons-item social-twitter">
                            <a class="social-icons-link" href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="social-icons-item social-youtube">
                            <a class="social-icons-link" href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mt-5">
                    <a class="btn btn-sm btn-outline-light" href="{{ route('home') }}">
                        {{ __('Back to home!') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
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