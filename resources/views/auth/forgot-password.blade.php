<x-layout title="Recupera Password | Studi Legali Uniti"
    description="Richiedi il link per impostare una nuova password." robots="noindex, nofollow"
    :styles="['resources/css/auth.css']">
    <section class="auth-wrapper" aria-labelledby="auth-heading">
        <div class="auth-card">
            <header class="auth-header">
                <a href="{{ route('homepage') }}" class="auth-logo-link"
                    aria-label="Torna alla homepage di Studi Legali Uniti">
                    Studi Legali Uniti
                </a>
                <h1 id="auth-heading" class="auth-title">Recupera la password</h1>
            </header>

            <div class="auth-body">
                <p class="auth-copy">
                    Inserisci l'indirizzo email associato al tuo account: ti invieremo un link per impostare una nuova
                    password.
                </p>

                @if (session('status'))
                    <div class="auth-alert auth-alert--success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" novalidate>
                    @csrf

                    <div class="auth-field">
                        <label for="email" class="auth-label">Indirizzo email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" class="auth-input @error('email') auth-input--error @enderror"
                            @error('email') aria-describedby="email-error" aria-invalid="true" @enderror>
                        @error('email')
                            <span id="email-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="auth-submit-btn">Invia link di reset</button>
                </form>

                <a href="{{ route('login') }}" class="auth-inline-link">Torna al login</a>
            </div>
        </div>
    </section>
</x-layout>