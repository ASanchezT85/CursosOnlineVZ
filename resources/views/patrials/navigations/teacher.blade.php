@can('teacher')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Teacher') }}</a>
    <ul class="dropdown-menu" aria-labelledby="pagesMenu">
        <li> <a class="dropdown-item" href="#">{{ __('Manage Courses') }}</a></li>
        <li> <a class="dropdown-item" href="#">{{ __('Create courses') }}</a> </li>
        <li> <a class="dropdown-item" href="#">{{ __('My students') }}</a> </li>
    </ul>
</li>
@endcan