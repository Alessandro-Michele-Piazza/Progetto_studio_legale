@php
    $pageTitle = isset($category)
        ? "Articoli — {$category->name} | Studi Legali Consorziati"
        : 'Articoli Legali | Studi Legali Consorziati';
    $pageDesc = isset($category)
        ? "Articoli e approfondimenti in materia di {$category->name}. Aggiornamenti giuridici a cura degli Studi Legali Consorziati di Catania."
        : 'Articoli e approfondimenti giuridici a cura degli Studi Legali Consorziati di Catania. Diritto civile, penale, amministrativo e del lavoro.';
@endphp

@php
    $listingRoute = isset($category)
        ? route('articoli.categoria', $category)
        : route('articoli.index');
    $baseFilterQuery = array_filter([
        'publication_year' => $activePublicationYear ?? null,
        'author_id' => $activeAuthorId ?? null,
        'search' => $activeSearch ?? null,
    ], fn ($value) => filled($value));
    $hasSecondaryFilters = filled($activePublicationYear ?? null) || filled($activeAuthorId ?? null) || filled($activeSearch ?? null);
@endphp

<x-layout
    :title="$pageTitle"
    :description="$pageDesc"
    ogType="website"
>

    <section class="articles-hero" aria-label="Intestazione articoli">
        <div class="container">
            <span class="section-label">
                <i class="fas fa-newspaper me-2" aria-hidden="true"></i>Approfondimenti
            </span>
            <h1 class="section-title">
                @isset($category)
                    Articoli — {{ $category->name }}
                @else
                    Articoli Legali
                @endisset
            </h1>
            <div class="section-divider"></div>

            <div class="article-filters">
                <form method="GET" action="{{ $listingRoute }}" class="article-filters__top-row" id="article-listing-filters">
                    <div class="article-filters__search-wrap">
                        <label for="search" class="article-filters__label">Cerca</label>
                        <div class="article-filters__search-input-wrap">
                            <input type="text" id="search" name="search"
                                   class="article-filters__search-input"
                                   value="{{ $activeSearch ?? '' }}"
                                   placeholder="Cerca per titolo o contenuto…">
                            <button type="submit" class="article-filters__search-btn" aria-label="Cerca">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="article-filters__right">
                        <div class="article-filters__field">
                            <label for="publication_year" class="article-filters__label">Anno</label>
                            <select id="publication_year" name="publication_year" class="article-filters__select">
                                <option value="">Tutti gli anni</option>
                                @foreach($availablePublicationYears as $publicationYear)
                                    <option value="{{ $publicationYear }}" @selected((string) $publicationYear === ($activePublicationYear ?? ''))>
                                        {{ $publicationYear }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="article-filters__field">
                            <label for="author_id" class="article-filters__label">Autore</label>
                            <select id="author_id" name="author_id" class="article-filters__select">
                                <option value="">Tutti gli autori</option>
                                @foreach($availableAuthors as $author)
                                    <option value="{{ $author->id }}" @selected((string) $author->id === ($activeAuthorId ?? ''))>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="article-filters__actions">
                            <button type="submit" class="article-filters__submit">
                                <i class="fas fa-filter me-2" aria-hidden="true"></i>Filtra
                            </button>
                            @if($hasSecondaryFilters)
                                <a href="{{ $listingRoute }}" class="article-filters__reset">Azzera</a>
                            @endif
                        </div>
                    </div>
                </form>

                <nav class="article-filters__categories" aria-label="Filtra per categoria">
                <a href="{{ route('articoli.index', $baseFilterQuery) }}"
                   class="article-filters__category-link {{ !isset($category) ? 'article-filters__category-link--active' : '' }}">
                    Tutti
                </a>
                @foreach($availableCategories as $filterCategory)
                    <a href="{{ route('articoli.categoria', ['category' => $filterCategory] + $baseFilterQuery) }}"
                       class="article-filters__category-link {{ (isset($category) && $category->id === $filterCategory->id) ? 'article-filters__category-link--active' : '' }}">
                        {{ $filterCategory->name }}
                    </a>
                @endforeach
                </nav>
            </div>
        </div>
    </section>

    <section class="articles-list-section" aria-label="Elenco articoli">
        <div class="container">
            @if($articles->isEmpty())
                <p class="articles-empty">Nessun articolo disponibile al momento.</p>
            @else
                <div class="articles-grid">
                    @foreach($articles as $article)
                        <x-article-card :article="$article" />
                    @endforeach
                </div>

                {{ $articles->links('pagination.articles') }}
            @endif

            @auth
                <div class="articles-admin-bar">
                    <a href="{{ route('articoli.create') }}" class="btn-site">
                        <i class="fas fa-plus me-2" aria-hidden="true"></i>Nuovo Articolo
                    </a>
                </div>
            @endauth
        </div>
    </section>

</x-layout>
