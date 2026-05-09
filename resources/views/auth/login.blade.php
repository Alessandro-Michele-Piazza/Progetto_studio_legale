<x-layout
    title="Accedi | Studi Legali Uniti"
    description="Accedi all'area riservata degli Studi Legali Uniti."
    robots="noindex, nofollow"
    :styles="['resources/css/auth.css']"
>
    @push('scripts')
        @vite('resources/js/auth-password-toggle.js')
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
                <h1 id="auth-heading" class="auth-title">Accedi al tuo account</h1>
            </header>

            <div class="auth-body">
                @if(session('status'))
                    <div class="auth-alert auth-alert--success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    @if($errors->has('g-recaptcha-response'))
                        <div class="auth-alert auth-alert--error" role="alert">
                            {{ $errors->first('g-recaptcha-response') }}
                        </div>
                    @endif

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
                            autofocus
                            @error('email') aria-describedby="email-error" aria-invalid="true" @enderror
                        >
                        @error('email')
                            <span id="email-error" class="auth-error" role="alert">{{ $message }}</span>
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
                                autocomplete="current-password"
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

                    <input type="text" name="login_company_name" class="auth-hp-field" tabindex="-1" autocomplete="off" aria-hidden="true">

                    <div class="auth-field">
                        @if(config('services.recaptcha.site_key'))
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @else
                            <span class="auth-error" role="alert">reCAPTCHA non configurato. Accesso temporaneamente disabilitato.</span>
                        @endif
                    </div>

                    <button type="submit" class="auth-submit-btn">Accedi</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>