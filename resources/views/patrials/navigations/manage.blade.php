@can('settings')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="demosMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Manage') }}</a>
    <div class="dropdown-menu pb-3 pb-lg-0" aria-labelledby="demosMenu">
        <div class="d-block d-sm-flex">
            <ul class="list-unstyled w-100 w-sm-50 pr-0 pr-lg-5">
                <li class="dropdown-header">{{ __('Manage WEB') }}</li>
                <li><a class="dropdown-item" href="{{ route('courses') }}">{{ __('Courses') }}</a></li>
                <li> <a class="dropdown-item" href="#">{{ __('Students') }}</a> </li>
                <li> <a class="dropdown-item" href="#">{{ __('Teacher') }}</a> </li>
            </ul>
            <ul class="list-unstyled w-100 w-sm-50 pr-0 pr-lg-5">
                <li class="dropdown-header">{{ __('User control') }}</li>
                <li> <a class="dropdown-item" href="#">{{ __('Users') }}</a> </li>
                <li><a class="dropdown-item" href="#">{{ __('Roles and Permissions') }}</a></li>
                <li class="dropdown-header">{{ __('Configurations') }}</li>
                <li>
                    <a class="dropdown-item" href="{{ route('categories') }}">
                        {{ __('Categories') }}
                    </a>
                </li>
                <li> <a class="dropdown-item" href="{{ route('statuses') }}">{{ __('Statuses') }}</a> </li>
                <li> <a class="dropdown-item" href="{{ route('levels') }}">{{ __('Levels') }}</a> </li>
            </ul>
        </div>
        <!-- mega menu Bottom -->
        <div class="w-100 bg-grad pattern-overlay-2 p-4 mt-3 all-text-white d-none d-lg-flex">
        </div>
    </div>
</li>
@endcan