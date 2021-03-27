<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4f50dbfe50.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/buttons.css" rel="stylesheet">
    <link href="/css/smart_table.css" rel="stylesheet">
    <link href="/css/layout.css" rel="stylesheet">
    <link href="/css/landing-page.min.css" rel="stylesheet">

</head>

<body>
    <div class="page-container">
        <div class="content-wrap">
            <div id="app">
                <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('img/logo.png')}}" alt="Pasaporte" height="40px">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                @hasRoles(['Administrador', 'Alumno'])
                                <li class="nav-item mr-2 ml-2">
                                    <a class="nav-link {{ Request::path() === '/' ? 'active' : '' }}" href="{{ url('/home') }}">{{ __('Home') }}</a>
                                </li>
                                @endhasRoles
                                @hasRole('Administrador')
                                <li class="nav-item mr-2 ml-2">
                                    <a class="nav-link {{ Request::path() === 'users' ? 'active' : '' }}" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                                </li>
                                <li class="nav-item mr-2 ml-2">
                                    <a class="nav-link {{ Request::path() === 'sesiones' ? 'active' : '' }}" href="{{ route('sesions.index') }}">{{ __('Pasports') }}</a>
                                </li>
                                <li class="nav-item mr-2 ml-2">
                                    <a class="nav-link {{ Request::path() === 'clases' ? 'active' : '' }}" href="{{ route('clases.index') }}">{{ __('Classes') }}</a>
                                </li>
                                <li class="nav-item mr-2 ml-2">
                                    <a class="nav-link {{ Request::path() === 'coaches' ? 'active' : '' }}" href="{{ route('coaches.index') }}">{{ __('Coaches') }}</a>
                                </li>
                                <li class="nav-item mr-2 ml-2">
                                    <a class="nav-link {{ Request::path() === 'anuncios' ? 'active' : '' }}" href="{{ route('anuncios.index') }}">{{ __('Announcements') }}</a>
                                </li>
                                @endhasRole
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
                <main class="py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="card">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <x-footer />
    </div>
</body>

</html>