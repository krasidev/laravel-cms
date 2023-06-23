<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/backend.css') }}">

    @yield('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/backend.js') }}"></script>
</head>
<body>
    <div id="backend" class="d-flex flex-column position-absolute inset-0">
        <nav class="navbar navbar-dark bg-dark border-bottom shadow-sm w-100">
            <a href="{{ url('/') }}" class="navbar-brand">
                {{ config('app.name', 'Laravel') }}
            </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                        <a href="{{ route('backend.profile.edit') }}" class="dropdown-item @if(request()->routeIs('backend.profile.edit')) active @endif">
                            <i class="fas fa-user mr-2"></i>{{ __('menu.backend.profile.edit') }}
                        </a>

                        <hr class="dropdown-divider">

                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-power-off mr-2"></i>{{ __('Logout') }}
                        </a>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>

            <div class="navbar-expand-md">
                <button type="button" class="navbar-toggler button_hamburger_htra ml-3" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span></span>
                </button>
            </div>
        </nav>

        <div class="flex-grow-1 d-flex flex-row-reverse flex-md-row overflow-hidden">
            <div class="d-flex navbar-expand-md flex-shrink-0">
                <div id="navbarNav" class="bg-white shadow-sm navbar-collapse width collapse flex-fill">
                    <nav id="backend-side-navbar">
                        <div class="input-group has-clear p-3">
                            <input type="text" id="backend-side-nav-search" class="form-control" placeholder="{{ __('menu.backend.searchbar') }}">

                            <div class="input-group-append">
                                <button type="button" class="btn btn-clear btn-clear-hidden">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <hr class="dropdown-divider m-0">

                        <div id="backend-side-nav-group" class="flex-grow-1 overflow-auto on-hover">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    @php
                                        $isOpenCollapseGoogleAnalytics = request()->routeIs('backend.google-analytics.*');
                                    @endphp
                                    <a href="#collapseGoogleAnalytics" class="nav-link d-flex align-items-center @if(!$isOpenCollapseGoogleAnalytics) collapsed @endif" data-toggle="collapse" aria-expanded="{{ $isOpenCollapseGoogleAnalytics ? 'true' : 'false' }}" aria-controls="collapseGoogleAnalytics">
                                        <i class="fas fa-chart-simple mr-2"></i>
                                        {{ __('menu.backend.google-analytics.text') }}
                                        <i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
                                    </a>
                                    <div id="collapseGoogleAnalytics" class="collapse @if($isOpenCollapseGoogleAnalytics) show @endif">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('backend.google-analytics.urls') }}" class="nav-link @if(request()->routeIs('backend.google-analytics.urls')) active @endif">
                                                    {{ __('menu.backend.google-analytics.urls') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('backend.google-analytics.locations') }}" class="nav-link @if(request()->routeIs('backend.google-analytics.locations')) active @endif">
                                                    {{ __('menu.backend.google-analytics.locations') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('backend.google-analytics.languages') }}" class="nav-link @if(request()->routeIs('backend.google-analytics.languages')) active @endif">
                                                    {{ __('menu.backend.google-analytics.languages') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('backend.google-analytics.browsers') }}" class="nav-link @if(request()->routeIs('backend.google-analytics.browsers')) active @endif">
                                                    {{ __('menu.backend.google-analytics.browsers') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('backend.google-analytics.device-categories') }}" class="nav-link @if(request()->routeIs('backend.google-analytics.device-categories')) active @endif">
                                                    {{ __('menu.backend.google-analytics.device-categories') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('backend.google-analytics.operating-systems') }}" class="nav-link @if(request()->routeIs('backend.google-analytics.operating-systems')) active @endif">
                                                    {{ __('menu.backend.google-analytics.operating-systems') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    @php
                                        $isOpenCollapseProjects = request()->routeIs('backend.projects.*');
                                    @endphp
                                    <a href="#collapseProjects" class="nav-link d-flex align-items-center @if(!$isOpenCollapseProjects) collapsed @endif" data-toggle="collapse" aria-expanded="{{ $isOpenCollapseProjects ? 'true' : 'false' }}" aria-controls="collapseProjects">
                                        <i class="fas fa-diagram-project mr-2"></i>
                                        {{ __('menu.backend.projects.text') }}
                                        <i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
                                    </a>
                                    <div id="collapseProjects" class="collapse @if($isOpenCollapseProjects) show @endif">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('backend.projects.index') }}" class="nav-link @if(request()->routeIs('backend.projects.index')) active @endif">
                                                    {{ __('menu.backend.projects.index') }}
                                                </a>
                                            </li>

                                            @can('manage_system')
                                                <li class="nav-item">
                                                    <a href="{{ route('backend.projects.create') }}" class="nav-link @if(request()->routeIs('backend.projects.create')) active @endif">
                                                        {{ __('menu.backend.projects.create') }}
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    @php
                                        $isOpenCollapseUsers = request()->routeIs('backend.users.*');
                                    @endphp
                                    <a href="#collapseUsers" class="nav-link d-flex align-items-center @if(!$isOpenCollapseUsers) collapsed @endif" data-toggle="collapse" aria-expanded="{{ $isOpenCollapseUsers ? 'true' : 'false' }}" aria-controls="collapseUsers">
                                        <i class="fas fa-users mr-2"></i>
                                        {{ __('menu.backend.users.text') }}
                                        <i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
                                    </a>

                                    <div id="collapseUsers" class="collapse @if($isOpenCollapseUsers) show @endif">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('backend.users.index') }}" class="nav-link @if(request()->routeIs('backend.users.index')) active @endif">
                                                    {{ __('menu.backend.users.index') }}
                                                </a>
                                            </li>

                                            @can('manage_system')
                                                <li class="nav-item">
                                                    <a href="{{ route('backend.users.create') }}" class="nav-link @if(request()->routeIs('backend.users.create')) active @endif">
                                                        {{ __('menu.backend.users.create') }}
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <main class="flex-md-shrink-1 flex-shrink-0 w-100 overflow-auto py-3">
                <div class="container-fluid">
                    @yield('content')
                </div>

                @yield('scripts')
            </main>
        </div>
    </div>

    <script>
        $('.select2').select2({
            allowClear: true
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success.title') }}',
                text: '{{ session('success.text') }}',
                confirmButtonText: '{{ __('messages.sweetalert2.success.confirm-button-text') }}'
            });
        </script>
    @endif
</body>
</html>
