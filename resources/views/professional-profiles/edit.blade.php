<x-layout
    title="Profilo Professionale | Studi Legali Consorziati"
    description="Gestisci il tuo profilo professionale da mostrare nella pagina contatti."
    robots="noindex, nofollow"
>
    <section class="article-form-section" aria-label="Modifica profilo professionale">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="article-editor__panel">
                        <span class="section-label">
                            <i class="fas fa-id-card me-2" aria-hidden="true"></i>Area Riservata
                        </span>
                        <h1 class="section-title">Il tuo Profilo Professionale</h1>
                        <div class="section-divider"></div>

                        @if(session('success'))
                            <div class="article-editor__alert" role="alert">
                                <p class="article-editor__alert-title">
                                    <i class="fas fa-check-circle me-2" aria-hidden="true"></i>
                                    {{ session('success') }}
                                </p>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="article-editor__alert" role="alert">
                                <p class="article-editor__alert-title">
                                    <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i>
                                    Correggi i seguenti errori:
                                </p>
                                <ul class="article-editor__alert-list">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('professional-profile.update') }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <label for="display_name" class="article-editor__label">Nome visualizzato</label>
                                    <input
                                        id="display_name"
                                        type="text"
                                        name="display_name"
                                        class="article-editor__control @error('display_name') article-editor__control--error @enderror"
                                        value="{{ old('display_name', $profile?->display_name) }}"
                                        placeholder="Es. Avv. Mario Rossi"
                                        required
                                    >
                                    @error('display_name')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="specialization" class="article-editor__label">Area di competenza</label>
                                    <input
                                        id="specialization"
                                        type="text"
                                        name="specialization"
                                        class="article-editor__control @error('specialization') article-editor__control--error @enderror"
                                        value="{{ old('specialization', $profile?->specialization) }}"
                                        placeholder="Es. Diritto Civile"
                                        required
                                    >
                                    @error('specialization')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="phone" class="article-editor__label">Telefono</label>
                                    <input
                                        id="phone"
                                        type="text"
                                        name="phone"
                                        class="article-editor__control @error('phone') article-editor__control--error @enderror"
                                        value="{{ old('phone', $profile?->phone) }}"
                                        placeholder="Es. 345 6789012"
                                        required
                                    >
                                    @error('phone')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="icon" class="article-editor__label">Icona Font Awesome</label>
                                    <input
                                        id="icon"
                                        type="text"
                                        name="icon"
                                        class="article-editor__control @error('icon') article-editor__control--error @enderror"
                                        value="{{ old('icon', $profile?->icon ?? 'fa-user-tie') }}"
                                        placeholder="Es. fa-balance-scale"
                                    >
                                    @error('icon')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="address" class="article-editor__label">Indirizzo studio</label>
                                    <input
                                        id="address"
                                        type="text"
                                        name="address"
                                        class="article-editor__control @error('address') article-editor__control--error @enderror"
                                        value="{{ old('address', $profile?->address ?? 'Via G. Simili, 14 - Catania') }}"
                                        required
                                    >
                                    @error('address')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="description" class="article-editor__label">Descrizione professionale</label>
                                    <textarea
                                        id="description"
                                        name="description"
                                        rows="8"
                                        class="article-editor__control article-editor__control--textarea @error('description') article-editor__control--error @enderror"
                                        required
                                    >{{ old('description', $profile?->description) }}</textarea>
                                    @error('description')
                                        <span class="article-editor__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn-site article-editor__submit">
                                        <i class="fas fa-save me-2" aria-hidden="true"></i>
                                        Salva Profilo
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
