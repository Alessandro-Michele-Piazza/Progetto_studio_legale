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
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'intervention_area' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Il nome è obbligatorio.',
            'first_name.max' => 'Il nome non può superare i 100 caratteri.',
            'last_name.required' => 'Il cognome è obbligatorio.',
            'last_name.max' => 'Il cognome non può superare i 100 caratteri.',
            'intervention_area.required' => 'L\'area di intervento è obbligatoria.',
            'intervention_area.max' => 'L\'area di intervento non può superare i 150 caratteri.',
            'email.required' => 'L\'email è obbligatoria.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'message.required' => 'Il messaggio è obbligatorio.',
            'message.min' => 'Il messaggio deve contenere almeno 10 caratteri.',
            'message.max' => 'Il messaggio non può superare i 3000 caratteri.',
        ];
    }
}
