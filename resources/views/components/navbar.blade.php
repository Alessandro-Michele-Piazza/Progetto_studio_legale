<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <!-- Logo/Nome Studio -->
        <a class="navbar-brand" href="{{ route('homepage') }}">
            STUDI LEGALI UNITI
        </a>

        <!-- Hamburger Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu + Social -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <!-- Menu Principale -->
            <ul class="navbar-nav ms-auto me-4">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('homepage') }}">Gli Studi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Aree d'intervento
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Diritto Civile</a></li>
                        <li><a class="dropdown-item" href="#">Diritto Penale</a></li>
                        <li><a class="dropdown-item" href="#">Diritto del Lavoro</a></li>
                        <li><a class="dropdown-item" href="#">Diritto di Famiglia</a></li>
                        <li><a class="dropdown-item" href="#">Diritto Amministrativo</a></li>
                        <li><a class="dropdown-item" href="#">Diritto Tributario</a></li>
                        <li><a class="dropdown-item" href="#">Diritto Internazionale</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Articoli</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contatti') }}">Contatti</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
