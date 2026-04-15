<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private const AREA_LABELS = [
        'civile'          => 'Diritto Civile',
        'penale'          => 'Diritto Penale',
        'lavoro'          => 'Diritto del Lavoro',
        'famiglia'        => 'Diritto di Famiglia',
        'amministrativo'  => 'Diritto Amministrativo',
        'tributario'      => 'Diritto Tributario',
        'internazionale'  => 'Diritto Internazionale',
        'altro'           => 'Altro',
    ];

    public function send(ContactRequest $request)
    {
        // Honeypot: se il campo nascosto è compilato, è un bot
        if ($request->filled('website')) {
            // Restituiamo un messaggio di successo fittizio
            return back()->with('success', 'Messaggio inviato con successo. Vi contatteremo al più presto.');
        }

        // Timing check: form compilato in meno di 3 secondi = bot
        $timestamp = (int) $request->input('_ts', 0);
        if ($timestamp > 0 && (time() - $timestamp) < 3) {
            return back()->with('success', 'Messaggio inviato con successo. Vi contatteremo al più presto.');
        }

        $validated = $request->validated();

        $data = [
            'nome'       => $validated['nome'],
            'cognome'    => $validated['cognome'],
            'email'      => $validated['email'],
            'telefono'   => $validated['telefono'] ?? '—',
            'area'       => $validated['area'],
            'area_label' => self::AREA_LABELS[$validated['area']] ?? $validated['area'],
            'messaggio'  => $validated['messaggio'],
        ];

        Mail::to(config('mail.from.address'))->send(new ContactFormMail($data));

        return back()->with('success', 'La Vostra richiesta è stata inviata con successo. Vi contatteremo entro 24 ore lavorative.');
    }
}
