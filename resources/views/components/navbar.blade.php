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
                        @foreach($navCategories ?? [] as $category)
                            <li><a class="dropdown-item"
                                    href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articoli.index') }}">Articoli</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contatti') }}">Contatti</a>
                </li>


                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                            <li>
                                <a href="{{ route('articoli.create') }}" class="dropdown-item">Nuovo Articolo</a>
                            </li>

                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>