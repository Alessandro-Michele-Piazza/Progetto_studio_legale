<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container px-3">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('homepage') }}">
            STUDI LEGALI UNITI
        </a>

        <!-- Hamburger Mobile (sarà a destra automaticamente) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'homepage' ? 'active' : '' }}"
                        href="{{ route('homepage') }}">Gli Studi</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAree" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Aree d'intervento
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAree">
                        @foreach($navCategories ?? [] as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('categories.show', data_get($category, 'slug')) }}">
                                    {{ data_get($category, 'name') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'articoli.index' ? 'active' : '' }}"
                        href="{{ route('articoli.index') }}">Articoli</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'contatti' ? 'active' : '' }}"
                        href="{{ route('contatti') }}">Contatti</a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="{{ route('articoli.create') }}" class="dropdown-item">Nuovo Articolo</a></li>
                            <li><a href="{{ route('contact-cards.index') }}" class="dropdown-item">Gestione Avvocati</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" style="border-color: rgba(197, 160, 89, 0.2)">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>