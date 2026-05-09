<x-layout :title="$category->name . ' | Studi Legali Consorziati'"
    :description="\Illuminate\Support\Str::limit(strip_tags($category->description), 160)">

    {{-- HERO CATEGORIA --}}
    <section class="category-hero" aria-label="Area di intervento">
        <div class="container">
            <span class="section-label">Area di intervento</span>
            <h1 class="section-title category-hero__title">{{ $category->name }}</h1>
            <div class="section-divider"></div>
            <p class="category-hero__description">{{ $category->description }}</p>
        </div>
    </section>

    {{-- AVVOCATO DI RIFERIMENTO --}}
    <section class="category-lawyer" aria-label="Avvocato di riferimento">
        <div class="container">
            <div class="category-lawyer__card">
                <div class="category-lawyer__avatar" aria-hidden="true">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="category-lawyer__info">
                    <span class="section-label">Il tuo riferimento legale</span>
                    <h2 class="category-lawyer__name">{{ $category->lawyer_name }}</h2>
                    <p class="category-lawyer__spec">{{ $category->lawyer_specialization }}</p>
                    <p class="category-lawyer__bio">{{ $category->lawyer_bio }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ULTIMI ARTICOLI --}}
    <section class="category-articles" aria-label="Articoli della categoria">
        <div class="container">
            <span class="section-label">
                <i class="fas fa-newspaper me-2" aria-hidden="true"></i>Approfondimenti
            </span>
            <h2 class="section-title">Ultimi articoli</h2>
            <div class="section-divider"></div>

            @if($articles->isEmpty())
                <p class="articles-empty">Nessun articolo disponibile per questa categoria.</p>
            @else
                <div class="articles-grid">
                    @foreach($articles as $article)
                        <x-article-card :article="$article" />
                    @endforeach
                </div>
            @endif

            <div class="category-articles__cta">
                <a href="{{ route('articoli.categoria', $category) }}" class="btn-site">
                    <i class="fas fa-th-list me-2" aria-hidden="true"></i>
                    Tutti gli articoli
                </a>
            </div>
        </div>
    </section>


</x-layout>