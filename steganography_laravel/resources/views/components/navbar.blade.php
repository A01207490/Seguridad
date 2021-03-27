<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto  d-flex align-items-center">


            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === '/' ? 'active' : '' }}" href="{{ url('/') }}">
                    <img src="{{ asset('img/icons/pasaporte.svg')}}" alt="Pasaporte" height="40px">
                </a>
            </li>

            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === '/' ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === 'users' ? 'active' : '' }}" href="{{ route('users.index') }}">Alumnos</a>
            </li>
            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === 'sesiones' ? 'active' : '' }}" href="{{ route('sesions.index') }}">Pasaportes</a>
            </li>
            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === 'coaches' ? 'active' : '' }}" href="{{ route('coaches.index') }}">Coaches</a>
            </li>
            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === 'clases' ? 'active' : '' }}" href="{{ route('clases.index') }}">Clases</a>
            </li>
            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === 'anuncios' ? 'active' : '' }}" href="{{ route('anuncios.index') }}">Anuncios</a>
            </li>
        </ul>
    </div>
</nav>