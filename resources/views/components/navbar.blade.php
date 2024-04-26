<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Portfolio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">Page d'accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">A Propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('career') }}">Parcours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('experience') }}">Expériences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Déconnexion</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
