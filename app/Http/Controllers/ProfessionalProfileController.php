<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfessionalProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $profile = $request->user()->professionalProfile;

        return view('professional-profiles.edit', compact('profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'specialization' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'display_name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
        ]);

        ProfessionalProfile::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'specialization' => $validated['specialization'],
                'description' => $validated['description'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'display_name' => $validated['display_name'],
                'icon' => $validated['icon'] ?: 'fa-user-tie',
            ]
        );

        return redirect()
            ->route('professional-profile.edit')
            ->with('success', 'Profilo professionale aggiornato con successo.');
    }
}
