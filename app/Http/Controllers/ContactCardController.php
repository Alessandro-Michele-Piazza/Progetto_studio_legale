<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactCardRequest;
use App\Models\ContactCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ContactCardController extends Controller
{
    public function index(): View
    {
        ContactCard::ensureFixedCards();

        $cards = ContactCard::with('professionals')
            ->orderBy('area_name', 'asc')
            ->get();

        return view('contact-cards.index', compact('cards'));
    }

    public function edit(ContactCard $contactCard): View
    {
        abort_unless(array_key_exists($contactCard->area_name, ContactCard::FIXED_CARDS), 404);

        $contactCard->load('professionals');

        return view('contact-cards.edit', compact('contactCard'));
    }

    public function update(UpdateContactCardRequest $request, ContactCard $contactCard): RedirectResponse
    {
        abort_unless(array_key_exists($contactCard->area_name, ContactCard::FIXED_CARDS), 404);

        $data = $request->validated();

        DB::transaction(function () use ($contactCard, $request, $data): void {
            $contactCard->update([
                'description' => $data['description'],
                'updated_by' => $request->user()->id,
            ]);

            $contactCard->professionals()->delete();

            foreach (array_values($data['professionals']) as $index => $professional) {
                $contactCard->professionals()->create([
                    'professional_name' => $professional['professional_name'],
                    'phone' => $professional['phone'],
                    'email' => $professional['email'],
                    'sede' => $professional['sede'],
                    'sort_order' => $index + 1,
                ]);
            }
        });

        return redirect()
            ->route('contact-cards.index')
            ->with('success', 'Card aggiornata con successo.');
    }
}
