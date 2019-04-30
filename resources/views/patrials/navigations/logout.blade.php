<div class="navbar-nav">
    <!-- extra item Search
    <div class="nav-item search border-0 pl-3 pr-0 px-lg-2" id="search">
        <a class="nav-link" data-toggle="collapse" href="#search-open"><i class="ti-search"> </i></a>
    </div> -->
    <!-- extra item Btn-->
    <div class="nav-item border-0 d-none d-lg-inline-block align-self-center ml-2">
        @guest
            <a href="{{ route('login') }}" class=" btn btn-sm btn-outline-white mb-0" style="min-width: 100px">
                {{ __('Login') }}
            </a>
        @else
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="lengMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="lengMenu">
                        <li><a class="dropdown-item" href="#">{{ __('My profile') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ __('My bills') }}</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            
        @endguest
    </div>
    <!-- extra item Btn-->
    
    <div class="nav-item border-0 d-none d-lg-inline-block align-self-center ml-2">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="lengMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="dropdown-item-icon" 
                        src="{{ (config('app.locale') != 'es') ? asset('images/uk.svg') :  asset('images/sp.svg')}}"
                        alt="{{ (config('app.locale') != 'es') ? __("English") : __("Spanish") }}">
                        {{ (config('app.locale') != 'es') ? __("English") : __("Spanish") }}
                
                </a>
                <ul class="dropdown-menu" aria-labelledby="lengMenu">
                    <li>
                        <a class="dropdown-item" href="{{ route('set_language', ['es']) }}">
                            <img class="dropdown-item-icon" src="{{ asset('images/sp.svg') }}" alt="{{  __("Spanish") }}">
                            {{  __("Spanish") }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('set_language', ['en']) }}">
                            <img class="dropdown-item-icon" src="{{ asset('images/uk.svg') }}" alt="{{  __("English") }}">
                            {{  __("English") }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
