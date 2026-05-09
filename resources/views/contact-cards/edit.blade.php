<x-layout
    title="Modifica Card Contatti | Studi Legali Consorziati"
    description="Modifica i dati della card contatti selezionata."
    robots="noindex, nofollow"
>
    <section class="py-5" style="margin-top: 70px;">
        <div class="container" style="max-width: 900px;">
            <a href="{{ route('contact-cards.index') }}" class="btn btn-link ps-0 mb-3">&larr; Torna alla gestione contatti</a>

            <div class="bg-white border p-4 p-md-5">
                <h1 class="font-title mb-2">Modifica area: {{ $contactCard->area_name }}</h1>
                <p class="text-muted mb-4">Puoi aggiungere un numero illimitato di avvocati: ogni nome verrà mostrato su riga distinta nella card pubblica.</p>

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact-cards.update', $contactCard) }}" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Area</label>
                        <input type="text" class="form-control" value="{{ $contactCard->area_name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="professional_name" class="form-label">Nome professionista</label>
                        <input
                            id="professional_name"
                            type="text"
                            name="professional_name"
                            class="form-control @error('professional_name') is-invalid @enderror"
                            value="{{ old('professional_name', $contactCard->professional_name) }}"
                            required
                        >
                        @error('professional_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefono</label>
                            <input
                                id="phone"
                                type="text"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $contactCard->phone) }}"
                                required
                            >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $contactCard->email) }}"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            class="form-control @error('description') is-invalid @enderror"
                            required
                        >{{ old('description', $contactCard->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Avvocati della card</h2>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-professional-row">Aggiungi avvocato</button>
                    </div>

                    @error('professionals')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    @php
                        $rows = old('professionals', $contactCard->professionals->map(fn ($p) => [
                            'professional_name' => $p->professional_name,
                            'phone' => $p->phone,
                            'email' => $p->email,
                            'sede' => $p->sede,
                        ])->toArray());

                        if (count($rows) === 0) {
                            $rows = [[
                                'professional_name' => '',
                                'phone' => '',
                                'email' => '',
                                'sede' => '',
                            ]];
                        }
                    @endphp

                    <div id="professionals-wrapper" class="d-flex flex-column gap-3 mb-4">
                        @foreach($rows as $index => $row)
                            <div class="border rounded p-3 professional-row" data-index="{{ $index }}">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <strong>Avvocato #{{ $loop->iteration }}</strong>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-professional-row">Rimuovi</button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="professional_name_{{ $index }}">Nome</label>
                                    <input
                                        id="professional_name_{{ $index }}"
                                        type="text"
                                        name="professionals[{{ $index }}][professional_name]"
                                        class="form-control @error('professionals.'.$index.'.professional_name') is-invalid @enderror"
                                        value="{{ $row['professional_name'] ?? '' }}"
                                        required
                                    >
                                    @error('professionals.'.$index.'.professional_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="phone_{{ $index }}">Telefono</label>
                                        <input
                                            id="phone_{{ $index }}"
                                            type="text"
                                            name="professionals[{{ $index }}][phone]"
                                            class="form-control @error('professionals.'.$index.'.phone') is-invalid @enderror"
                                            value="{{ $row['phone'] ?? '' }}"
                                            required
                                        >
                                        @error('professionals.'.$index.'.phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="email_{{ $index }}">Email</label>
                                        <input
                                            id="email_{{ $index }}"
                                            type="email"
                                            name="professionals[{{ $index }}][email]"
                                            class="form-control @error('professionals.'.$index.'.email') is-invalid @enderror"
                                            value="{{ $row['email'] ?? '' }}"
                                            required
                                        >
                                        @error('professionals.'.$index.'.email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label" for="sede_{{ $index }}">Sede</label>
                                    <input
                                        id="sede_{{ $index }}"
                                        type="text"
                                        name="professionals[{{ $index }}][sede]"
                                        class="form-control @error('professionals.'.$index.'.sede') is-invalid @enderror"
                                        value="{{ $row['sede'] ?? '' }}"
                                        required
                                    >
                                    @error('professionals.'.$index.'.sede')
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
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const wrapper = document.getElementById('professionals-wrapper');
                const addButton = document.getElementById('add-professional-row');
                let nextIndex = wrapper.querySelectorAll('.professional-row').length;

                const createRow = function (index) {
                    const container = document.createElement('div');
                    container.className = 'border rounded p-3 professional-row';
                    container.setAttribute('data-index', String(index));

                    container.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong>Avvocato #${index + 1}</strong>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-professional-row">Rimuovi</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="professionals[${index}][professional_name]" class="form-control" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="professionals[${index}][phone]" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="professionals[${index}][email]" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Sede</label>
                            <input type="text" name="professionals[${index}][sede]" class="form-control" required>
                        </div>
                    `;

                    return container;
                };

                addButton.addEventListener('click', function () {
                    wrapper.appendChild(createRow(nextIndex));
                    nextIndex += 1;
                });

                wrapper.addEventListener('click', function (event) {
                    const trigger = event.target;

                    if (!trigger.classList.contains('remove-professional-row')) {
                        return;
                    }

                    const rows = wrapper.querySelectorAll('.professional-row');

                    if (rows.length <= 1) {
                        return;
                    }

                    trigger.closest('.professional-row')?.remove();
                });
            });
        </script>
    @endpush
</x-layout>
