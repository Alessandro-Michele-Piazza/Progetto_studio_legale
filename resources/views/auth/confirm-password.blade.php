<x-layout
    title="Conferma Password | Studi Legali Uniti"
    description="Conferma la password per continuare."
    robots="noindex, nofollow"
    :styles="['resources/css/auth.css']"
>
    @push('scripts')
        @vite('resources/js/auth-password-toggle.js')
    @endpush

    <section class="auth-wrapper" aria-labelledby="auth-heading">
        <div class="auth-card">
            <header class="auth-header">
                <a href="{{ route('homepage') }}" class="auth-logo-link" aria-label="Torna alla homepage di Studi Legali Uniti">
                    Studi Legali Uniti
                </a>
                <h1 id="auth-heading" class="auth-title">Conferma la password</h1>
            </header>

            <div class="auth-body">
                <p class="auth-copy">
                    Per motivi di sicurezza, inserisci la tua password prima di proseguire.
                </p>

                <form method="POST" action="{{ route('password.confirm.store') }}" novalidate>
                    @csrf

                    <div class="auth-field">
                        <label for="password" class="auth-label">Password</label>
                        <div class="password-field">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="auth-input @error('password') auth-input--error @enderror"
                                @error('password') aria-describedby="password-error" aria-invalid="true" @enderror>
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

                    <button type="submit" class="auth-submit-btn">Conferma</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
