<x-layout
    title="Contatti | Studi Legali Consorziati Catania"
    description="Contatta i nostri professionisti specializzati in diritto civile, penale, amministrativo e del lavoro."
>
    <section class="contatti-hero">
        <div class="container">
            <span class="section-label">Siamo al tuo servizio</span>
            <h1 class="contatti-hero__title">Contatti</h1>
            <p class="contatti-hero__subtitle">
                Le aree di intervento sono aggiornate dinamicamente dal database.
            </p>
        </div>
    </section>

    <section class="contatti-main-section">
        <div class="container">
            <div class="contatti-info-grid">
                @forelse($cards as $card)
                    <article class="contatti-info-card">
                        <div class="contatti-info-card__icon">
                            <i class="fas {{ $card->icon_class }}" aria-hidden="true"></i>
                        </div>

                        <strong class="contatti-info-card__label">{{ $card->area_name }}</strong>
                        <p class="contatti-info-card__text">{{ $card->description }}</p>

                        <div class="contatti-info-card__professional">
                            @forelse($card->professionals as $professional)
                                <div class="mb-3 pb-3 border-bottom">
                                    <span class="professional-name">{{ $professional->professional_name }}</span>

                                    <div class="professional-detail">
                                        <i class="fas fa-location-dot" aria-hidden="true"></i>
                                        <span>{{ $professional->sede }}</span>
                                    </div>

                                    <div class="professional-detail">
                                        <i class="fas fa-phone" aria-hidden="true"></i>
                                        <a href="tel:{{ preg_replace('/\s+/', '', $professional->phone) }}">{{ $professional->phone }}</a>
                                    </div>

                                    <div class="professional-detail">
                                        <i class="fas fa-envelope" aria-hidden="true"></i>
                                        <a href="mailto:{{ $professional->email }}">{{ $professional->email }}</a>
                                    </div>
                                </div>
                            @empty
                                <span class="professional-name">Nessun professionista assegnato</span>
                            @endforelse
                        </div>
                    </article>
                @empty
                    <article class="contatti-info-card">
                        <div class="contatti-info-card__icon">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                        </div>
                        <strong class="contatti-info-card__label">Aree in aggiornamento</strong>
                        <p class="contatti-info-card__text">
                            Le card di contatto sono in fase di aggiornamento. Torna tra poco.
                        </p>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    @auth
        <section class="contatti-main-section pt-0">
            <div class="container text-center">
                <a href="{{ route('contact-cards.index') }}" class="btn-site">Gestione Contatti</a>
            </div>
        </section>
    @endauth
</x-layout>