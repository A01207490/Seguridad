<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto  d-flex align-items-center">
            <li class="nav-item mr-2 ml-2">
                <a class="nav-link {{ Request::path() === '/' ? 'active' : '' }}" href="{{ url('/') }}">Steganography</a>
            </li>
        </ul>
    </div>
</nav>