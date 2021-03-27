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

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @if (Route::has('login'))

                                @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/home') }}">{{ __('Home') }}</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @endif

                                @endif

                            </ul>
                        </div>
                    </div>
                </nav>

                <main class="py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="card">
                                    <section class="features-icons bg-secondary text-center text-white">
                                        <div class="container">
                                            <div class="row d-flex justify-content-center">

                                                <div class="col-lg-4">

                                                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                                                        <img class="img-fluid rounded-circle mb-3 p-2" src="img/logo.png" alt="">
                                                        <h1>Pasaporte Deportivo</h1>
                                                        <p class="lead mb-0">!Entrena a tu tiempo y a tu ritmo!</p>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </section>

                                    <!-- Image Showcases -->
                                    <section class="showcase">
                                        <div class="container-fluid p-0">
                                            <div class="row no-gutters">
                                                <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-0.jpg');"></div>
                                                <div class="col-lg-6 my-auto showcase-text">
                                                    <h2>Registra tu cuenta</h2>
                                                    <p class="lead mb-0">Crea una cuenta con tu correo institucional del Tec para inscribirte en el programa.</p>
                                                </div>
                                            </div>

                                            <div class="row no-gutters">
                                                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-1.jpg');"></div>
                                                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                                                    <h2>Descarga la App</h2>
                                                    <p class="lead mb-0">Descarga la App para que puedas comenzar a registrar tus sesiones.</p>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
                                                <div class="col-lg-6 my-auto showcase-text">
                                                    <h2>Requisitos</h2>
                                                    <p class="lead mb-0">
                                                        Cumplir 30 sesiones de 30 minutos como mínimo.
                                                    </p>
                                                    <p class="lead mb-0">
                                                        Realizar las pruebas físicas al menos una vez.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-3.jpg');"></div>
                                                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                                                    <h2>Beneficios</h2>
                                                    <p class="lead mb-0">
                                                        Participar en clases o clínicas deportivas que desees.
                                                    </p>
                                                    <p class="lead mb-0">
                                                        Cuenta para tu registro de actividades extracurriculares.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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