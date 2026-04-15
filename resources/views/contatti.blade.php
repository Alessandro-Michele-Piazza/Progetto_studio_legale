<x-layout
    title="Contatti | Studi Legali Consorziati – Catania"
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

    {{-- MAPPA --}}
    <section class="contatti-mappa-section" aria-label="Mappa sede dello studio">
        <div class="contatti-mappa-header">
            <div class="container text-center">
                <span class="section-label">
                    <i class="fas fa-location-dot me-2" aria-hidden="true"></i>Sede
                </span>
                <h2 class="section-title">Dove Trovarci</h2>
                <div class="section-divider"></div>
            </div>
        </div>

        <div class="contatti-mappa-wrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.7373271360298!2d15.094047675536432!3d37.514112972052196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1313fcceaacf3385%3A0xa9c58cbdc6c55c72!2sVia%20Giuseppe%20Simili%2C%2014%2C%2095129%20Catania%20CT!5e0!3m2!1sit!2sit!4v1776268544416!5m2!1sit!2sit"
                title="Sede degli Studi Legali Consorziati – Via Giuseppe Simili 14, 95129 Catania"
                allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

</x-layout>