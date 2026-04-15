<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            Mail::to(config('mail.from.address'))->send(new ContactFormMail($validated));
        } catch (\Exception $e) {
            Log::error('Errore invio email contatto', ['error' => $e->getMessage()]);

            return back()
                ->withInput()
                ->with('error', 'Si è verificato un errore nell\'invio. Riprova più tardi.');
        }

        return back()->with('success', 'Messaggio inviato con successo. Ti risponderemo entro 24 ore lavorative.');
    }
}
