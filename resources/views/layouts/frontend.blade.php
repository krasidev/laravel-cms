<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if ($tracking_id = config('system.tracking_id'))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tracking_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $tracking_id }}');
    </script>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('url', url()->full())">
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }} - @yield('title')">
    <meta property="og:description" content="@yield('description', config('system.description', 'Description'))">
    @hasSection('image')<meta property="og:image" content="@yield('image')">@endif

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="@yield('url', url('index.php'))">
    <meta property="twitter:title" content="{{ config('app.name', 'Laravel') }} - @yield('title')">
    <meta property="twitter:description" content="@yield('description', config('system.description', 'Description'))">
    @hasSection('image')<meta property="twitter:image" content="@yield('image')">@endif

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <meta name="description" content="@yield('description', config('system.description', 'Description'))">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

    @yield('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/frontend.js') }}"></script>
</head>
<body>
    <div id="frontend">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navbarNav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">
                                        <i class="fas fa-sign-in mr-2"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">
                                        <i class="fas fa-user-plus mr-2"></i>{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('backend.profile.edit') }}" class="dropdown-item">
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pt-5 pb-4 bg-light">
            <div class="container">
                @yield('content')
            </div>

            @yield('scripts')
        </main>
    </div>
</body>
</html>
