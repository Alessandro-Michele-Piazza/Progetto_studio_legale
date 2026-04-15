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
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email:rfc', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Il nome è obbligatorio.',
            'name.max'         => 'Il nome non può superare i 100 caratteri.',
            'email.required'   => 'L\'email è obbligatoria.',
            'email.email'      => 'Inserisci un indirizzo email valido.',
            'message.required' => 'Il messaggio è obbligatorio.',
            'message.min'      => 'Il messaggio deve contenere almeno 10 caratteri.',
            'message.max'      => 'Il messaggio non può superare i 3000 caratteri.',
        ];
    }
}
