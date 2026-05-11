<x-layout
    title="Verifica 2FA | Studi Legali Uniti"
    description="Inserisci il codice di autenticazione a due fattori."
    robots="noindex, nofollow"
    :styles="['resources/css/auth.css']"
>
    <section class="auth-wrapper" aria-labelledby="auth-heading">
        <div class="auth-card">
            <header class="auth-header">
                <a href="{{ route('homepage') }}" class="auth-logo-link" aria-label="Torna alla homepage di Studi Legali Uniti">
                    Studi Legali Uniti
                </a>
                <h1 id="auth-heading" class="auth-title">Autenticazione a due fattori</h1>
            </header>

            <div class="auth-body">
                <p class="auth-copy">
                    Inserisci il codice generato dalla tua app di autenticazione.
                    In alternativa, puoi usare un codice di recupero.
                </p>

                <form method="POST" action="{{ route('two-factor.login.store') }}" novalidate>
                    @csrf

                    <div class="auth-field">
                        <label for="code" class="auth-label">Codice di autenticazione</label>
                        <input
                            id="code"
                            type="text"
                            name="code"
                            autocomplete="one-time-code"
                            class="auth-input @error('code') auth-input--error @enderror"
                            @error('code') aria-describedby="code-error" aria-invalid="true" @enderror
                        >
                        @error('code')
                            <span id="code-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="recovery_code" class="auth-label">Codice di recupero (opzionale)</label>
                        <input
                            id="recovery_code"
                            type="text"
                            name="recovery_code"
                            class="auth-input @error('recovery_code') auth-input--error @enderror"
                            @error('recovery_code') aria-describedby="recovery-code-error" aria-invalid="true" @enderror
                        >
                        @error('recovery_code')
                            <span id="recovery-code-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="auth-submit-btn">Verifica accesso</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
