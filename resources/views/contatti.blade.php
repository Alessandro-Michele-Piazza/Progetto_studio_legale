<x-layout title="Contatti | Studi Legali Consorziati – Catania"
    description="Contatta gli Studi Legali Consorziati a Catania. Trova i nostri recapiti e la mappa della sede.">

    {{-- HERO --}}
    <section class="contatti-hero" aria-label="Intestazione pagina contatti">
        <div class="container text-center">
            <span class="section-label">Studio Legale</span>
            <h1 class="contatti-hero__title">Contattaci</h1>
            <p class="contatti-hero__subtitle">
                Il nostro team è a tua disposizione per una consulenza legale personalizzata
            </p>
        </div>
    </section>

    {{-- MAIN: INFO --}}
    <section class="contatti-main-section" aria-label="Recapiti dello studio">
        <div class="container">

            <div class="contatti-info-grid">

                {{-- Card Indirizzo --}}
                <div class="contatti-info-card">
                    <div class="contatti-info-card__icon">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    </div>
                    <strong class="contatti-info-card__label">Indirizzo</strong>
                    <p class="contatti-info-card__text">
                        Via Giuseppe Simili, 14<br>
                        95129 Catania (CT)
                    </p>
                </div>

                {{-- Card Telefono --}}
                <div class="contatti-info-card">
                    <div class="contatti-info-card__icon">
                        <i class="fas fa-phone" aria-hidden="true"></i>
                    </div>
                    <strong class="contatti-info-card__label">Telefono</strong>
                    <p class="contatti-info-card__text">
                        <a href="tel:+39095530951">+39 095 530951</a>
                    </p>
                </div>

                {{-- Card Email --}}
                <div class="contatti-info-card">
                    <div class="contatti-info-card__icon">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                    </div>
                    <strong class="contatti-info-card__label">Email</strong>
                    <p class="contatti-info-card__text">
                        vallonelegal@gmail.com
                    </p>
                </div>

                {{-- Card Orari --}}
                <div class="contatti-info-card">
                    <div class="contatti-info-card__icon">
                        <i class="fas fa-clock" aria-hidden="true"></i>
                    </div>
                    <strong class="contatti-info-card__label">Orari di Ricevimento</strong>
                    <p class="contatti-info-card__text">
                        Lunedì – Venerdì: 09:00 – 19:00<br>
                        Su appuntamento.
                    </p>
                </div>

            </div>

        </div>
    </section>


</x-layout>