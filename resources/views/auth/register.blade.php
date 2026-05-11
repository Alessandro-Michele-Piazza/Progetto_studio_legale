<x-layout
    title="Registrazione | Studi Legali Uniti"
    description="Crea un nuovo account per l'area riservata degli Studi Legali Uniti."
    robots="noindex, nofollow"
    :styles="['resources/css/auth.css']"
>
    @push('scripts')
        @vite('resources/js/auth-password-toggle.js')
        @vite('resources/js/auth-profile-image-preview.js')
        @if(config('services.recaptcha.site_key'))
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        @endif
    @endpush

    <section class="auth-wrapper" aria-labelledby="auth-heading">
        <div class="auth-card">
            <header class="auth-header">
                <a href="{{ route('homepage') }}" class="auth-logo-link" aria-label="Torna alla homepage di Studi Legali Uniti">
                    Studi Legali Uniti
                </a>
                <h1 id="auth-heading" class="auth-title">Crea un account</h1>
            </header>

            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    @if($errors->has('g-recaptcha-response'))
                        <div class="auth-alert auth-alert--error" role="alert">
                            {{ $errors->first('g-recaptcha-response') }}
                        </div>
                    @endif

                    <div class="auth-field">
                        <label for="first_name" class="auth-label">Nome</label>
                        <input
                            id="first_name"
                            type="text"
                            name="first_name"
                            class="auth-input @error('first_name') auth-input--error @enderror"
                            value="{{ old('first_name') }}"
                            required
                            autocomplete="given-name"
                            autofocus
                            @error('first_name') aria-describedby="first-name-error" aria-invalid="true" @enderror
                        >
                        @error('first_name')
                            <span id="first-name-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="last_name" class="auth-label">Cognome</label>
                        <input
                            id="last_name"
                            type="text"
                            name="last_name"
                            class="auth-input @error('last_name') auth-input--error @enderror"
                            value="{{ old('last_name') }}"
                            required
                            autocomplete="family-name"
                            @error('last_name') aria-describedby="last-name-error" aria-invalid="true" @enderror >
                        @error('last_name')
                            <span id="last-name-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="intervention_area" class="auth-label">Area di intervento</label>
                        <select
                            id="intervention_area"
                            name="intervention_area"
                            class="auth-input @error('intervention_area') auth-input--error @enderror"
                            required
                            @error('intervention_area') aria-describedby="intervention-area-error" aria-invalid="true" @enderror
                        >
                            <option value="">Seleziona un'area</option>
                            @foreach(['Diritto Civile', 'Diritto Penale', 'Diritto del Lavoro', 'Diritto Amministrativo', 'Altro'] as $area)
                                <option value="{{ $area }}" @selected(old('intervention_area') === $area)>{{ $area }}</option>
                            @endforeach
                        </select>
                        @error('intervention_area')
                            <span id="intervention-area-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="sede" class="auth-label">Sede</label>
                        <input
                            id="sede"
                            type="text"
                            name="sede"
                            class="auth-input @error('sede') auth-input--error @enderror"
                            value="{{ old('sede') }}"
                            required
                            autocomplete="address-level2"
                            @error('sede') aria-describedby="sede-error" aria-invalid="true" @enderror
                        >
                        @error('sede')
                            <span id="sede-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="email" class="auth-label">Indirizzo email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="auth-input @error('email') auth-input--error @enderror"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            @error('email') aria-describedby="email-error" aria-invalid="true" @enderror
                        >
                        @error('email')
                            <span id="email-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="profile_image" class="auth-label">Foto profilo (opzionale)</label>
                        <div class="auth-profile-upload">
                            <img src="{{ asset('media/Portrait_Placeholder.webp') }}" id="profile-image-preview"
                                class="auth-profile-preview" alt="Anteprima foto profilo" width="72"
                                height="72" loading="lazy" decoding="async"
                                onerror="this.onerror=null;this.src='{{ asset('media/Portrait_Placeholder.webp') }}';">
                            <input
                                id="profile_image"
                                type="file"
                                name="profile_image"
                                class="auth-input @error('profile_image') auth-input--error @enderror"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                data-placeholder-image="{{ asset('media/Portrait_Placeholder.webp') }}"
                                @error('profile_image') aria-describedby="profile-image-error" aria-invalid="true" @enderror
                            >
                        </div>
                        @error('profile_image')
                            <span id="profile-image-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password" class="auth-label">Password</label>
                        <div class="password-field">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="auth-input @error('password') auth-input--error @enderror"
                                required
                                autocomplete="new-password"
                                @error('password') aria-describedby="password-error" aria-invalid="true" @enderror
                            >
                            <button
                                type="button"
                                class="password-toggle-btn"
                                data-target="password"
                                aria-label="Mostra password"
                            >
                                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('password')
                            <span id="password-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password-confirm" class="auth-label">Conferma password</label>
                        <div class="password-field">
                            <input
                                id="password-confirm"
                                type="password"
                                name="password_confirmation"
                                class="auth-input"
                                required
                                autocomplete="new-password"
                            >
                            <button
                                type="button"
                                class="password-toggle-btn"
                                data-target="password-confirm"
                                aria-label="Mostra conferma password"
                            >
                                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <input type="text" name="company_name" class="auth-hp-field" tabindex="-1" autocomplete="off" aria-hidden="true">

                    <div class="auth-field">
                        @if(config('services.recaptcha.site_key'))
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @else
                            <span class="auth-error" role="alert">reCAPTCHA non configurato. Registrazione temporaneamente disabilitata.</span>
                        @endif
                    </div>

                    <div class="auth-actions-stack">
                        <button type="submit" class="auth-submit-btn">Crea account</button>
                        <a href="{{ route('login') }}" class="auth-secondary-btn">GIA' REGISTRATO</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>