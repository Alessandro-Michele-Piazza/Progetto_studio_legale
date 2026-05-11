<x-layout title="Modifica Card Contatti | Studi Legali Consorziati"
    description="Modifica i dati della card contatti selezionata." robots="noindex, nofollow"
    :styles="['resources/css/contact-cards.css']">
    <section class="py-5 contact-cards-section">
        <div class="container contact-cards-edit__container">
            <a href="{{ route('contact-cards.index') }}" class="btn-site my-5">&larr; Torna alla gestione avvocati</a>

            <div class="bg-white border p-4 p-md-5">
                <h1 class="font-title mb-2">Modifica area: {{ $contactCard->area_name }}</h1>
                <p class="text-muted mb-4">Puoi aggiungere un numero illimitato di avvocati: ogni nome verrà mostrato su
                    riga distinta nella card pubblica.</p>

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact-cards.update', $contactCard) }}" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Area</label>
                        <input type="text" class="form-control" value="{{ $contactCard->area_name }}" disabled>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Avvocati della card</h2>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-professional-row">Aggiungi
                            avvocato</button>
                    </div>

                    @error('professionals')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    @php
                        $rows = old('professionals', $contactCard->professionals->map(fn($p) => [
                            'professional_name' => $p->professional_name,
                            'phone' => $p->phone,
                            'email' => $p->email,
                            'existing_profile_image' => $p->profile_image,
                            'sede' => $p->sede,
                        ])->toArray());

                        if (count($rows) === 0) {
                            $rows = [
                                [
                                    'professional_name' => '',
                                    'phone' => '',
                                    'email' => '',
                                    'existing_profile_image' => null,
                                    'sede' => '',
                                ]
                            ];
                        }
                    @endphp

                    <div id="professionals-wrapper" class="d-flex flex-column gap-3 mb-4"
                        data-placeholder-image="{{ asset('media/Portrait_Placeholder.webp') }}">
                        @foreach($rows as $index => $row)
                            <div class="border rounded p-3 professional-row" data-index="{{ $index }}">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <strong>Avvocato #{{ $loop->iteration }}</strong>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger remove-professional-row">Rimuovi</button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="professional_name_{{ $index }}">Nome</label>
                                    <input id="professional_name_{{ $index }}" type="text"
                                        name="professionals[{{ $index }}][professional_name]"
                                        class="form-control @error('professionals.' . $index . '.professional_name') is-invalid @enderror"
                                        value="{{ $row['professional_name'] ?? '' }}" required>
                                    @error('professionals.' . $index . '.professional_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @php
                                    $existingProfileImage = $row['existing_profile_image'] ?? null;
                                    $profilePreview = $existingProfileImage
                                        ? asset('storage/' . ltrim($existingProfileImage, '/'))
                                        : asset('media/Portrait_Placeholder.webp');
                                @endphp

                                <input type="hidden" name="professionals[{{ $index }}][existing_profile_image]"
                                    value="{{ $existingProfileImage }}">

                                <div class="mb-3">
                                    <label class="form-label" for="profile_image_{{ $index }}">Foto profilo (opzionale)</label>
                                    <div class="contact-card-image-upload">
                                        <img src="{{ $profilePreview }}" class="contact-card-image-preview"
                                            alt="Anteprima foto profilo di {{ $row['professional_name'] ?? 'avvocato' }}"
                                            width="56" height="56" loading="lazy" decoding="async">
                                        <input id="profile_image_{{ $index }}" type="file"
                                            name="professionals[{{ $index }}][profile_image]"
                                            class="form-control @error('professionals.' . $index . '.profile_image') is-invalid @enderror"
                                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                    </div>
                                    @error('professionals.' . $index . '.profile_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="phone_{{ $index }}">Telefono</label>
                                        <input id="phone_{{ $index }}" type="text" name="professionals[{{ $index }}][phone]"
                                            class="form-control @error('professionals.' . $index . '.phone') is-invalid @enderror"
                                            value="{{ $row['phone'] ?? '' }}" required>
                                        @error('professionals.' . $index . '.phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="email_{{ $index }}">Email</label>
                                        <input id="email_{{ $index }}" type="email"
                                            name="professionals[{{ $index }}][email]"
                                            class="form-control @error('professionals.' . $index . '.email') is-invalid @enderror"
                                            value="{{ $row['email'] ?? '' }}" required>
                                        @error('professionals.' . $index . '.email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label" for="sede_{{ $index }}">Sede</label>
                                    <input id="sede_{{ $index }}" type="text" name="professionals[{{ $index }}][sede]"
                                        class="form-control @error('professionals.' . $index . '.sede') is-invalid @enderror"
                                        value="{{ $row['sede'] ?? '' }}" required>
                                    @error('professionals.' . $index . '.sede')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn-site">Salva modifiche</button>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
        @vite('resources/js/contact-card-professionals.js')
    @endpush
</x-layout>