<x-layout title="Contatti | Studi Legali Consorziati – Catania"
    description="Contattateci per una consulenza legale personalizzata. Siamo a vostra disposizione per assistervi in ogni ambito del diritto. Scoprite i nostri recapiti e compilate il modulo di contatto per richiedere un appuntamento con i nostri avvocati esperti."
    keywords="contatti studio legale, consulenza legale, recapiti, modulo di contatto, avvocati Catania, assistenza legale, diritto civile, diritto penale, diritto del lavoro, diritto di famiglia, diritto amministrativo, diritto tributario, diritto internazionale">

    <!-- ================================================
         SEZIONE PRINCIPALE: INFO + FORM
         ================================================ -->
    <section class="contatti-main-section" aria-label="Recapiti e modulo di contatto">
        <div class="container">
            <div class="row g-5 align-items-start">

                <!-- ---- COLONNA SINISTRA: Recapiti ---- -->
                <div class="col-lg-5">
                    <div class="contatti-card contatti-card--info">
                        <span class="section-label">
                            <i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i>Recapiti
                        </span>
                        <h2 class="section-title">I Nostri Contatti</h2>
                        <div class="section-divider"></div>

                        <ul class="contatti-lista" aria-label="Informazioni di contatto">
                            <li class="contatti-item">
                                <span class="contatti-icona" aria-hidden="true">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <div>
                                    <strong class="contatti-item-label">Indirizzo</strong>
                                    <p class="contatti-item-testo">
                                        Via Giuseppe Simili, 14<br>
                                        95129 Catania (CT)
                                    </p>
                                </div>
                            </li>
                            <li class="contatti-item">
                                <span class="contatti-icona" aria-hidden="true">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <div>
                                    <strong class="contatti-item-label">Telefono</strong>
                                    <p class="contatti-item-testo">
                                        <a href="tel:+39095530951">+39 095 530951</a>
                                    </p>
                                </div>
                            </li>
                            <li class="contatti-item">
                                <span class="contatti-icona" aria-hidden="true">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <div>
                                    <strong class="contatti-item-label">Email</strong>
                                    <p class="contatti-item-testo">
                                        <a href="mailto:vallonelegal@gmail.com">vallonelegal@gmail.com</a>
                                    </p>
                                </div>
                            </li>
                            <li class="contatti-item">
                                <span class="contatti-icona" aria-hidden="true">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <div>
                                    <strong class="contatti-item-label">Orari di Ricevimento</strong>
                                    <p class="contatti-item-testo">
                                        Lunedì – Venerdì: 09:00 – 19:00<br>
                                        Riceviamo esclusivamente su appuntamento, per garantire la massima
                                        professionalità.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- ---- COLONNA DESTRA: Modulo ---- -->
                <div class="col-lg-7">
                    <div class="contatti-card contatti-card--form">
                        <span class="section-label">
                            <i class="fas fa-pen-nib me-2" aria-hidden="true"></i>Richiesta
                        </span>
                        <h2 class="section-title">Richiedi una Consulenza</h2>
                        <div class="section-divider"></div>

                        <p class="contatti-form-intro">
                            Compilate il modulo per richiedere un primo colloquio conoscitivo con uno
                            dei nostri avvocati. Il team vi contatterà entro 24 ore lavorative per
                            definire modalità e tempistiche dell'incontro, nel pieno rispetto della
                            <strong>riservatezza</strong> delle informazioni fornite.
                        </p>

                        <form action="{{ route('contatti.send') }}" method="POST" novalidate
                            aria-label="Modulo richiesta consulenza">
                            @csrf
                            <input type="hidden" name="_ts" value="{{ time() }}">

                            {{-- Honeypot anti-spam (nascosto via CSS) --}}
                            <div class="contatti-hp" aria-hidden="true">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                            </div>

                            {{-- Messaggio di successo --}}
                            @if(session('success'))
                                <div class="contatti-alert contatti-alert--success" role="alert">
                                    <i class="fas fa-check-circle me-2" aria-hidden="true"></i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Errore di invio --}}
                            @if(session('error'))
                                <div class="contatti-alert contatti-alert--error" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i>
                                    {{ session('error') }}
                                </div>
                            @endif

                            {{-- Errori di validazione --}}
                            @if($errors->any())
                                <div class="contatti-alert contatti-alert--error" role="alert">
                                    <p class="contatti-alert-title">
                                        <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i>
                                        Si prega di correggere i seguenti errori:
                                    </p>
                                    <ul class="contatti-alert-list">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-4">

                                <div class="col-sm-6">
                                    <label for="nome" class="contatti-form-label">
                                        Nome <abbr title="Campo obbligatorio" aria-label="obbligatorio">*</abbr>
                                    </label>
                                    <input type="text"
                                        class="contatti-form-control @error('nome') contatti-form-control--error @enderror"
                                        id="nome" name="nome" value="{{ old('nome') }}" autocomplete="given-name"
                                        placeholder="Mario" required>
                                    @error('nome')
                                        <span class="contatti-field-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="cognome" class="contatti-form-label">
                                        Cognome <abbr title="Campo obbligatorio" aria-label="obbligatorio">*</abbr>
                                    </label>
                                    <input type="text"
                                        class="contatti-form-control @error('cognome') contatti-form-control--error @enderror"
                                        id="cognome" name="cognome" value="{{ old('cognome') }}"
                                        autocomplete="family-name" placeholder="Rossi" required>
                                    @error('cognome')
                                        <span class="contatti-field-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="email" class="contatti-form-label">
                                        Email <abbr title="Campo obbligatorio" aria-label="obbligatorio">*</abbr>
                                    </label>
                                    <input type="email"
                                        class="contatti-form-control @error('email') contatti-form-control--error @enderror"
                                        id="email" name="email" value="{{ old('email') }}" autocomplete="email"
                                        placeholder="mario.rossi@email.it" required>
                                    @error('email')
                                        <span class="contatti-field-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="telefono" class="contatti-form-label">Telefono</label>
                                    <input type="tel" class="contatti-form-control" id="telefono" name="telefono"
                                        value="{{ old('telefono') }}" autocomplete="tel" placeholder="+39 000 0000000">
                                </div>

                                <div class="col-12">
                                    <label for="area" class="contatti-form-label">
                                        Area Legale di Interesse <abbr title="Campo obbligatorio"
                                            aria-label="obbligatorio">*</abbr>
                                    </label>
                                    <div class="contatti-select-wrapper">
                                        <select
                                            class="contatti-form-control @error('area') contatti-form-control--error @enderror"
                                            id="area" name="area" required>
                                            <option value="" disabled {{ old('area') ? '' : 'selected' }}>Selezionate
                                                un'area di competenza</option>
                                            <option value="civile" {{ old('area') === 'civile' ? 'selected' : '' }}>
                                                Diritto Civile</option>
                                            <option value="penale" {{ old('area') === 'penale' ? 'selected' : '' }}>
                                                Diritto Penale</option>
                                            <option value="lavoro" {{ old('area') === 'lavoro' ? 'selected' : '' }}>
                                                Diritto del Lavoro</option>
                                            <option value="famiglia" {{ old('area') === 'famiglia' ? 'selected' : '' }}>
                                                Diritto di Famiglia</option>
                                            <option value="amministrativo" {{ old('area') === 'amministrativo' ? 'selected' : '' }}>Diritto Amministrativo</option>
                                            <option value="tributario" {{ old('area') === 'tributario' ? 'selected' : '' }}>Diritto Tributario</option>
                                            <option value="internazionale" {{ old('area') === 'internazionale' ? 'selected' : '' }}>Diritto Internazionale</option>
                                            <option value="altro" {{ old('area') === 'altro' ? 'selected' : '' }}>Altro
                                            </option>
                                        </select>
                                        @error('area')
                                            <span class="contatti-field-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="messaggio" class="contatti-form-label">
                                        Descrizione della Richiesta <abbr title="Campo obbligatorio"
                                            aria-label="obbligatorio">*</abbr>
                                    </label>
                                    <textarea
                                        class="contatti-form-control @error('messaggio') contatti-form-control--error @enderror"
                                        id="messaggio" name="messaggio" rows="5"
                                        placeholder="Descrivete brevemente la vostra situazione legale e la tipologia di assistenza richiesta…"
                                        required>{{ old('messaggio') }}</textarea>
                                    @error('messaggio')
                                        <span class="contatti-field-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-start gap-2">
                                        <input class="contatti-check-input flex-shrink-0 mt-1" type="checkbox"
                                            id="privacy" name="privacy" required>
                                        <label class="contatti-privacy-label font-body" for="privacy">
                                            Acconsento al trattamento dei dati personali ai sensi del
                                            <abbr title="Regolamento UE 2016/679">GDPR</abbr>
                                            e della normativa vigente in materia di protezione dei dati. *
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-gold contatti-btn-submit">
                                        <i class="fas fa-paper-plane me-2" aria-hidden="true"></i>
                                        Invia la Richiesta
                                    </button>
                                    <p class="contatti-required-note">* Campi obbligatori</p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================================================
         MAPPA
         ================================================ -->
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
                title="Sede degli Studi Legali Consorziati – Via Giuseppe Simili 14, 95129 Catania" allowfullscreen
                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

</x-layout>