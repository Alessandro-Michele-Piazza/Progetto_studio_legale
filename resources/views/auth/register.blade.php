<x-layout
    title="Registrazione | Studi Legali Uniti"
    description="Crea un nuovo account per l'area riservata degli Studi Legali Uniti."
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
                <h1 id="auth-heading" class="auth-title">Crea un account</h1>
            </header>

            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    <div class="auth-field">
                        <label for="name" class="auth-label">Nome e cognome</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            class="auth-input @error('name') auth-input--error @enderror"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            autofocus
                            @error('name') aria-describedby="name-error" aria-invalid="true" @enderror
                        >
                        @error('name')
                            <span id="name-error" class="auth-error" role="alert">{{ $message }}</span>
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

                    <button type="submit" class="auth-submit-btn">Crea account</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>