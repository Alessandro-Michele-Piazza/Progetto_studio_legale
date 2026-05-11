<x-layout
    title="Contatti | Studi Legali Consorziati Catania"
    description="Contatta i nostri professionisti specializzati in diritto civile, penale, amministrativo e del lavoro."
>
    <!-- HERO SECTION -->
    <section class="contatti-hero">
        <div class="container">
            <span class="section-label">Siamo al tuo servizio</span>
            <h1 class="contatti-hero__title">Contatti</h1>
            <p class="contatti-hero__subtitle">
                I nostri esperti sono a disposizione per consulenze legali mirate nelle diverse aree del diritto.
            </p>
        </div>
    </section>

    <!-- GRID CONTATTI -->
    <section class="contatti-main-section">
        <div class="container">
            <div class="contatti-info-grid">
                @forelse($cards as $card)
                    <article class="contatti-info-card">
                        <!-- BLOCCO SUPERIORE AD ALTEZZA FISSA -->
                        <div class="card-header-top">
                            <div class="card-icon">
                                <i class="fas {{ $card->icon_class }}" aria-hidden="true"></i>
                            </div>
                            <h2 class="card-title">{{ $card->area_name }}</h2>
                        </div>

                        <!-- LINEA DIVISORIA -->
                        <hr class="card-divider">

                        <!-- BLOCCO PROFESSIONISTI -->
                        <div class="card-professionals">
                            @forelse($card->professionals as $professional)
                                <div class="professional-item">
                                    <span class="professional-name">{{ $professional->professional_name }}</span>

                                    <div class="professional-detail">
                                        <i class="fas fa-location-dot"></i>
                                        <span>{{ $professional->sede }}</span>
                                    </div>

                                    <div class="professional-detail">
                                        <i class="fas fa-phone"></i>
                                        <a href="tel:{{ preg_replace('/\s+/', '', $professional->phone) }}">{{ $professional->phone }}</a>
                                    </div>

                                    <div class="professional-detail">
                                        <i class="fas fa-envelope"></i>
                                        <a href="mailto:{{ $professional->email }}">{{ $professional->email }}</a>
                                    </div>
                                </div>
                            @empty
                                <span class="professional-name">Nessun professionista assegnato</span>
                            @endforelse
                        </div>
                    </article>
                @empty
                    <div class="text-center w-100 py-5">
                        <p>Le card di contatto sono in fase di aggiornamento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- SEZIONE GESTIONE (SOLO PER LOGGATI) -->
    @auth
        <section class="contatti-main-section pt-0">
            <div class="container text-center">
                <a href="{{ route('contact-cards.index') }}" class="btn-site">Gestione Avvocati</a>
            </div>
        </section>
    @endauth
</x-layout>