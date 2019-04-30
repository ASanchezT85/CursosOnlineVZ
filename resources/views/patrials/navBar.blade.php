<header class="navbar-transparent navbar-sticky navbar-primary">
    <!-- Search -->
    <div class="top-search collapse bg-light" id="search-open" data-parent="#search">
        <div class="container">
            <div class="row position-relative">
                <div class="col-md-8 mx-auto py-5">
                    <form>
                        <div class="input-group">
                            <input class="form-control border-radius-right-0 border-right-0" type="text" name="search" autofocus="" placeholder="What are you looking for?">
                            <button type="button" class="btn btn-grad border-radius-left-0 mb-0">Search</button>
                        </div>
                    </form>
                    <p class="small mt-2 mb-0"><strong>e.g.</strong>Template, Wizixo, WordPress theme </p>
                </div>
                <a class="position-absolute top-0 right-0 mt-3 mr-3" data-toggle="collapse" href="#search-open"><i class="fa fa-window-close"></i></a>
            </div>
        </div>
    </div>
    <!-- End Search -->

    <!-- Logo Nav Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="navbar-brand-item" src="{{ asset('images/logo-4.png') }}" alt="{{ config('app.name', 'Laravel') }}">
            </a>
            <!-- Menu opener button -->
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"> </span>
          </button>
            <!-- Main Menu Start -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <!-- Menu item 0 anage-->
                    @include('patrials.navigations.manage')
                    <!-- Menu item 1 Categories-->
                    @include('patrials.navigations.categories')
                    <!-- Menu item 2 Blog-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="blogMenu">Blog</a>
                    </li>
                    @can('students')
                    <!-- Menu item 3 Students-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="mycourses">{{ __('My courses') }}</a>
                    </li>
                    @endcan
                    <!-- Menu item 4 Teacher-->
                    @include('patrials.navigations.teacher')</ul>
            </div>
            <!-- Main Menu End -->
            <!-- Header Extras Start-->
            @include('patrials.navigations.logout')
            <!-- Header Extras End-->
        </div>
    </nav>
    <!-- Logo Nav End -->
</header>
@guest

<section class="p-0 py-5 bg-grad pattern-overlay-2">
    <div class="container">
        <div class="row py-0 py-md-5 justify-content-between align-items-center">
            <div class="col-sm-10 col-lg-6 all-text-white my-5 mt-md-0">
                <div class="text-left py-0 py-md-5 my-5">
                    <h6>{{ __('Do not wait any longer!') }}</h6>
                    <h2 class="display-5 display-lg-4 font-weight-normal">{{ __('You will not find anything better') }}.</h2>
                    <p class="mb-4 display-8 font-weight-normal">{{ __('Our staff has been responsible for selecting an incredible number of teachers to guide you in your training') }}.</p>                       
                    <a href="{{ route('register') }}" class=" btn btn-white" style="min-width: 100px">
                        {{ __('Sign up') }}
                    </a>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 d-none d-lg-block mb-5">
                <img class="rounded shadow" src="{{ asset('images/01.jpg') }}" alt="">
                <div class="pos-absolute-center">
                    <a class="btn btn-grad btn-round btn-lg zoom-on-hover" data-fancybox="" href="#"> <i class="fa fa-play"></i> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="position-absolute bottom-0 left-0 w-100 d-none d-md-block mb-n3">
        <svg width="100%" height="150" viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M0,150 L0,40 Q250,150 500,40 L580,150 Z" fill="white" />
        </svg>
    </div>
</section>

<section class="client p-0 mt-5 mt-md-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-grab" data-arrow="false" data-dots="false" data-items-xl="6" data-items-lg="5" data-items-md="4" data-items-sm="3" data-items-xs="2">
                    @foreach ($categories as $category)
                        <div class="item">
                            <img class="w-75" src="{{ $category->pathAttachment() }}" alt="{{ $category->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endguest