<x-layout title="Studio Legale | Consulenza Legale Specializzata - Studi Legali Consorziati"
    description="Gli Studi Legali Consorziati a Catania offrono consulenza legale specializzata in diritto civile, penale, amministrativo e del lavoro. Fondati nel 1998, siamo un punto di riferimento per privati, aziende e istituzioni in tutta la Sicilia. Contattaci per una consulenza personalizzata."
    :styles="['resources/css/welcome.css']">
    <!-- HERO SECTION con Video Background -->
    <header class="hero-section">
        <video autoplay muted loop playsinline poster="img/fallback-hero.jpg" class="video-bg">
            <source src="{{ asset('media/video_legge_generico.mp4') }}" type="video/mp4">
            Il tuo browser non supporta il video.
        </video>
        <div class="hero-overlay"></div>
        <div class="container hero-content text-center">
            <h1 class="display-3 font-title text-white mb-3">Studi Legali Consorziati</h1>
            <div class="hero-divider"></div>
            <p class="lead text-white mb-4 font-body">Consulenza legale specializzata dal 1998</p>
            <a href="#chi-siamo" class="button-home">
                <i class="fa-solid fa-arrow-down-long arrow-icon arrow"></i>
                <span class="text">Scopri di più</span>
            </a>
        </div>
    </header>

    <!-- CHI SIAMO -->
    <section id="chi-siamo" class="section-padding">
        <div class="container">
            <div class="chi-siamo-header">
                <span class="section-label"><i class="fas fa-balance-scale me-2"></i>Chi Siamo</span>
                <h2 class="section-title">Assistenza Legale Professionale a Catania</h2>
                <div class="section-divider"></div>
            </div>
            <div class="chi-siamo-text">
                <p>Gli <strong>Studi Legali Consorziati a Catania</strong> rappresentano un punto di riferimento per chi
                    cerca <strong>assistenza legale qualificata a Catania e in tutta la Sicilia</strong>. Fondati nel
                    1998 dall’unione di avvocati con competenze complementari, offriamo consulenza e difesa legale in
                    <strong>diritto civile, penale, amministrativo e del lavoro</strong>. Il nostro studio legale a
                    Catania supporta privati, aziende e istituzioni con un approccio professionale, trasparente e
                    orientato al risultato. Ogni pratica viene gestita con la massima attenzione, garantendo
                    <strong>riservatezza, tempestività e soluzioni personalizzate</strong>. Se cerchi un avvocato a
                    Catania affidabile ed esperto, il nostro team è pronto ad assisterti in ogni fase del procedimento
                    legale.
                </p>
            </div>
        </div>
    </section>

    <!-- PARALLAX SECTION con Aree d'Intervento -->
    <section class="parallax-section" data-bg="{{ asset('media/immagine_generica.webp') }}">
        <div class="parallax-overlay"></div>
        <div class="container parallax-content">
            <h2 class="parallax-title font-title">Aree d'Intervento</h2>
            <div class="parallax-divider"></div>
            <ul class="parallax-links">
                @foreach($categories as $category)
                    <li><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- ULTIMI ARTICOLI -->
    @if($latestArticles->isNotEmpty())
        <section class="section-padding latest-articles-section">
            <div class="container">
                <div class="chi-siamo-header">
                    <span class="section-label"><i class="fas fa-newspaper me-2"></i>Dal Nostro Blog</span>
                    <h2 class="section-title">Ultimi Articoli</h2>
                    <div class="section-divider"></div>
                </div>
                <div class="latest-articles-grid">
                    @foreach($latestArticles as $article)
                        <x-article-card :article="$article" />
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('articoli.index') }}" class="btn-site">
                        <i class="fas fa-arrow-right me-2"></i>Tutti gli Articoli
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA CONTATTI -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="font-title text-white mb-3">Hai bisogno di assistenza legale?</h2>
            <p class="text-white-50 mb-4 font-body">Contattaci per una consulenza personalizzata. Il primo colloquio è
                gratuito.</p>
            <a href="{{ route('contatti') }}" class="btn-site">
                <i class="fas fa-phone-alt me-2  "></i>Contattaci Ora
            </a>
        </div>
    </section>

</x-layout>