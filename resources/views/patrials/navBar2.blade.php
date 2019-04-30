<header class="navbar-floating navbar-sticky navbar-light">
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
                <ul class="navbar-nav mx-auto">
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
                    @include('patrials.navigations.teacher')
                </ul>
            </div>
            <!-- Main Menu End -->
            <!-- Header Extras Start-->
            @include('patrials.navigations.logout')
            <!-- Header Extras End-->
        </div>
    </nav>
    <!-- Logo Nav End -->
    </header>