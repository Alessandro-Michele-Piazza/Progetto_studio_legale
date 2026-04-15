<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'      => ['required', 'string', 'max:100'],
            'cognome'   => ['required', 'string', 'max:100'],
            'email'     => ['required', 'email:rfc,dns', 'max:255'],
            'telefono'  => ['nullable', 'string', 'max:30'],
            'area'      => ['required', 'string', 'in:civile,penale,lavoro,famiglia,amministrativo,tributario,internazionale,altro'],
            'messaggio' => ['required', 'string', 'min:10', 'max:5000'],
            'privacy'   => ['accepted'],
            // Honeypot: deve restare vuoto
            'website'   => ['nullable', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required'      => 'Il campo Nome è obbligatorio.',
            'nome.max'           => 'Il campo Nome non può superare i 100 caratteri.',
            'cognome.required'   => 'Il campo Cognome è obbligatorio.',
            'cognome.max'        => 'Il campo Cognome non può superare i 100 caratteri.',
            'email.required'     => 'Il campo Email è obbligatorio.',
            'email.email'        => 'Inserite un indirizzo email valido.',
            'telefono.max'       => 'Il campo Telefono non può superare i 30 caratteri.',
            'area.required'      => 'Selezionate un\'area legale di interesse.',
            'area.in'            => 'L\'area selezionata non è valida.',
            'messaggio.required' => 'Il campo Messaggio è obbligatorio.',
            'messaggio.min'      => 'Il messaggio deve contenere almeno 10 caratteri.',
            'messaggio.max'      => 'Il messaggio non può superare i 5000 caratteri.',
            'privacy.accepted'   => 'È necessario acconsentire al trattamento dei dati.',
            'website.max'        => 'Invio non valido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nome'     => 'Nome',
            'cognome'  => 'Cognome',
            'email'    => 'Email',
            'telefono' => 'Telefono',
            'area'     => 'Area legale',
            'messaggio'=> 'Messaggio',
            'privacy'  => 'Consenso privacy',
        ];
    }
}
