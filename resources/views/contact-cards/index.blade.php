<x-layout
    title="Gestione Contatti | Studi Legali Consorziati"
    description="Dashboard per la modifica delle 4 card contatti fisse."
    robots="noindex, nofollow"
>
    <section class="py-5" style="margin-top: 70px;">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="font-title mb-2">Gestione Contatti</h1>
                    <p class="mb-0 text-muted">Sono disponibili solo le 4 aree fisse. Puoi modificare i dati, non creare o eliminare card.</p>
                </div>
                <a href="{{ route('contatti') }}" class="btn-site">Torna a Contatti</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive bg-white border">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Area</th>
                            <th>Professionisti</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th class="text-end">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cards as $card)
                            <tr>
                                <td>
                                    <i class="fas {{ $card->icon_class }} me-2" aria-hidden="true"></i>
                                    {{ $card->area_name }}
                                </td>
                                <td>
                                    <strong>{{ $card->professionals->count() }}</strong>
                                    <span class="text-muted">professionisti</span>
                                </td>
                                <td>Multipli</td>
                                <td>Multipli</td>
                                <td class="text-end">
                                    <a href="{{ route('contact-cards.edit', $card) }}" class="btn btn-sm btn-outline-primary">Modifica</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layout>
