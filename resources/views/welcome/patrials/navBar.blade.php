<header class="header-static navbar-sticky navbar-light" id="home">
    <!-- Search -->
    <div class="top-search collapse bg-light" id="search-open" data-parent="#search">
        <div class="container">
            <div class="row position-relative">
                <div class="col-md-8 mx-auto py-5">
                    <form>
                        <div class="input-group">
                            <input class="form-control border-radius-right-0 border-right-0" type="text" name="search" autofocus placeholder="What are you looking for?">
                            <button type="button" class="btn btn-grad border-radius-left-0 mb-0">Search</button>
                        </div>
                    </form>
                    <p class="small mt-2 mb-0"><strong>e.g.</strong>PHP, Laravel, WordPress </p>
                </div>
                <a class="position-absolute top-0 right-0 mt-3 mr-3" data-toggle="collapse" href="#search-open"><i class="fa fa-window-close"></i></a>
            </div>
        </div>
    </div>
    <!-- End Search -->

    <!-- Navbar top start-->
    <div class="navbar-top d-none d-lg-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- navbar top Left-->
                <div class="d-flex align-items-center">
                    <!-- Language -->
                    <div class="dropdown">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="dropdown-item-icon" 
                            src="{{ (config('app.locale') != 'es') ? asset('images/uk.svg') :  asset('images/sp.svg')}}"
                            alt="{{ (config('app.locale') != 'es') ? __("English") : __("Spanish") }}">
                            {{ (config('app.locale') != 'es') ? __("English") : __("Spanish") }}
                        </a>
                      <div class="dropdown-menu mt-2 shadow" aria-labelledby="dropdownLanguage">
                        <span class="dropdown-item-text">{{ __('Select language') }}</span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <img class="dropdown-item-icon" src="{{ asset('images/uk.svg') }}" alt="{{  __("English") }}">
                            {{  __("English") }}
                        </a>
                        <a class="dropdown-item" href="#">
                            <img class="dropdown-item-icon" src="{{ asset('images/sp.svg') }}" alt="{{  __("Spanish") }}">
                            {{  __("Spanish") }}
                        </a>
                      </div>
                    </div>
                    <!-- Top info -->
                    <ul class="nav list-unstyled ml-3">
                        <li class="nav-item mr-3">
                            <a class="navbar-link" href="#"><strong>Phone:</strong> (000) 000-0000</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="navbar-link" href="#"><strong>Email:</strong> help@admuni.com</a>
                        </li>
                    </ul>
                </div>

                <!-- navbar top Right-->
                <div class="d-flex align-items-center">
                    <!-- Top Account -->
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-user mr-2"></i>{{ __('Account') }}</a>
                        <div class="dropdown-menu mt-2 shadow" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                        </div>
                    </div>
                    <!-- top link -->
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">{{ __('Contact') }}</a>
                        </li>
                    </ul>
                    <!-- top social -->
                    <ul class="social-icons">
                        <li class="social-icons-item social-facebook m-0">
                            <a class="social-icons-link w-auto px-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="social-icons-item social-instagram m-0">
                            <a class="social-icons-link w-auto px-2" href="#"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li class="social-icons-item social-twitter m-0">
                            <a class="social-icons-link w-auto pl-2" href="#"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="social-icons-item social-twitter m-0">
                            <a class="social-icons-link w-auto pl-2" href="#"><i class="fab fa-github"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar top End-->

    <!-- Logo Nav Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img class="navbar-brand-item" src="{{ asset('images/logo-4.png') }}" alt="{{ config('app.name', 'Laravel') }}">
            </a>
            <!-- Menu opener button -->
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <!-- Main Menu Start -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <!-- Menu item 1 Categories-->
                    @include('patrials.navigations.categories')
                    <!-- Menu item 2 Blog-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="blogMenu">Blog</a>
                    </li>
                </ul>
            </div>
            <!-- Main Menu End -->
            <!-- Header Extras Start-->
            <div class="navbar-nav">
                <!-- extra item Search-->
                <div class="nav-item search border-0 pl-3 pr-0 px-lg-2" id="search">
                    <a class="nav-link" data-toggle="collapse" href="#search-open"><i class="ti-search"> </i></a>
                </div>
                <!-- extra item Btn-->
                <div class="nav-item border-0 d-none d-lg-inline-block align-self-center">
                    <a href="{{ route('register') }}" class=" btn btn-sm btn-grad text-white mb-0">{{ __('Sign up') }}</a>
                </div>
            </div>
            <!-- Header Extras End-->
        </div>
    </nav>
    <!-- Logo Nav End -->
</header>