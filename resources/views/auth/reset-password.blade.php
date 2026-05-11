<x-layout
    title="Nuova Password | Studi Legali Uniti"
    description="Imposta una nuova password per il tuo account."
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
                <h1 id="auth-heading" class="auth-title">Imposta una nuova password</h1>
            </header>

            <div class="auth-body">
                <form method="POST" action="{{ route('password.update') }}" novalidate>
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="auth-field">
                        <label for="email" class="auth-label">Indirizzo email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $request->email) }}"
                            required
                            autocomplete="email"
                            class="auth-input @error('email') auth-input--error @enderror"
                            @error('email') aria-describedby="email-error" aria-invalid="true" @enderror
                        >
                        @error('email')
                            <span id="email-error" class="auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password" class="auth-label">Nuova password</label>
                        <div class="password-field">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="auth-input @error('password') auth-input--error @enderror"
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
                        <label for="password_confirmation" class="auth-label">Conferma password</label>
                        <div class="password-field">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="auth-input"
                            >
                            <button
                                type="button"
                                class="password-toggle-btn"
                                data-target="password_confirmation"
                                aria-label="Mostra conferma password"
                            >
                                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="auth-submit-btn">Aggiorna password</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
