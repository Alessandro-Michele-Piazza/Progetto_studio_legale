<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactProfileRequest;
use Illuminate\Http\RedirectResponse;

class ContactProfileController extends Controller
{
    public function update(UpdateContactProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->update([
            'name' => trim($validated['first_name'].' '.$validated['last_name']),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'intervention_area' => $validated['intervention_area'],
            'contact_notes' => $validated['contact_notes'] ?? null,
        ]);

        return redirect()
            ->route('contatti')
            ->with('profile_success', 'La tua sezione contatti è stata aggiornata correttamente.');
    }
}
