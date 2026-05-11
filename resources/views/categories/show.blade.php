<x-layout :title="$category->name . ' | Studi Legali Consorziati'"
    :description="\Illuminate\Support\Str::limit(strip_tags($category->description), 160)"
    :styles="['resources/css/articles/listing.css', 'resources/css/articles/category.css']">

    <div class="category-page">

        {{-- HERO CATEGORIA --}}
        <section class="category-hero" aria-label="{{ $category->name }}">
            <div class="container">
                <div class="category-hero__panel">
                    <div class="category-hero__badge-line"></div>
                    <h1 class="category-hero__title">{{ $category->name }}</h1>
                </div>
            </div>
        </section>

        {{-- AVVOCATO DI RIFERIMENTO --}}
        <section class="category-lawyer" aria-label="I tuoi riferimenti legali">
            <div class="container">
                @php
                    $professionals = $contactCard?->professionals ?? collect();
                @endphp

                @if($professionals->isNotEmpty())
                    <div class="category-section-heading">
                        <span class="section-label">I tuoi riferimenti legali</span>
                        <h2 class="section-title category-lawyer__title">Professionisti dedicati a {{ $category->name }}
                        </h2>
                        <div class="section-divider"></div>
                    </div>

                    <div class="category-lawyers__grid">
                        @foreach($professionals as $professional)
                            @php
                                $avatarSrc = $professional->profile_image
                                    ? asset('storage/' . ltrim($professional->profile_image, '/'))
                                    : asset('media/Portrait_Placeholder.webp');
                            @endphp

                            <article class="category-lawyer__card">
                                {{-- Icona/Avatar --}}
                                <div class="category-lawyer__avatar">
                                    <img src="{{ $avatarSrc }}" class="category-lawyer__avatar-image"
                                        alt="Foto profilo di {{ $professional->professional_name }}" width="64"
                                        height="64" loading="lazy" decoding="async"
                                        onerror="this.onerror=null;this.src='{{ asset('media/Portrait_Placeholder.webp') }}';">
                                </div>

                                <div class="category-lawyer__info">
                                    {{-- Nome con altezza minima per allineamento --}}
                                    <h2 class="category-lawyer__name">{{ $professional->professional_name }}</h2>
                                    <p class="category-lawyer__spec">{{ $category->name }}</p>

                                    {{-- Dettagli testuali (no link) --}}
                                    <div class="category-lawyer__details">
                                        @if($professional->sede)
                                            <div class="category-lawyer__detail">
                                                <i class="fas fa-location-dot"></i>
                                                <span>{{ $professional->sede }}</span>
                                            </div>
                                        @endif

                                        @if($professional->phone)
                                            <div class="category-lawyer__detail">
                                                <i class="fas fa-phone"></i>
                                                <span>{{ $professional->phone }}</span>
                                            </div>
                                        @endif

                                        @if($professional->email)
                                            <div class="category-lawyer__detail">
                                                <i class="fas fa-envelope"></i>
                                                <span>{{ $professional->email }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @auth
                        <div class="category-lawyers__actions">
                            <a href="{{ route('contact-cards.edit', $contactCard) }}" class="btn-site">Aggiungi avvocato</a>
                        </div>
                    @endauth
                @endif
            </div>
        </section>

        {{-- ULTIMI ARTICOLI --}}
        <section class="category-articles" aria-label="Articoli della categoria">
            <div class="container">
                <div class="category-section-heading">
                    <span class="section-label">
                        <i class="fas fa-newspaper me-2" aria-hidden="true"></i>Approfondimenti
                    </span>
                    <h2 class="section-title">Ultimi articoli</h2>
                    <div class="section-divider"></div>
                </div>

                @if($articles->isEmpty())
                    <p class="articles-empty">Nessun articolo disponibile per questa categoria.</p>
                @else
                    <div class="articles-grid category-articles__grid">
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

    </div>

</x-layout>