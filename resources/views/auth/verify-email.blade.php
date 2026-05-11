<x-layout
    title="Verifica Email | Studi Legali Uniti"
    description="Completa la verifica del tuo indirizzo email per accedere all'area riservata."
    robots="noindex, nofollow"
    :styles="['resources/css/auth.css']"
>
    <section class="auth-wrapper" aria-labelledby="auth-heading">
        <div class="auth-card">
            <header class="auth-header">
                <a href="{{ route('homepage') }}" class="auth-logo-link" aria-label="Torna alla homepage di Studi Legali Uniti">
                    Studi Legali Uniti
                </a>
                <h1 id="auth-heading" class="auth-title">Verifica il tuo indirizzo email</h1>
            </header>

            <div class="auth-body">
                <p class="auth-copy">
                    Ti abbiamo inviato un link di verifica all'indirizzo che hai usato in registrazione.
                    Apri l'email e clicca il link per attivare il tuo account.
                </p>

                @if (session('status') === 'verification-link-sent')
                    <div class="auth-alert auth-alert--success" role="alert">
                        Un nuovo link di verifica e' stato inviato con successo.
                    </div>
                @endif

                <div class="auth-actions-stack">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="auth-submit-btn">Invia un nuovo link</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="auth-secondary-btn">Esci</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
