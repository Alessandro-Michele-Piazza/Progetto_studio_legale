<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'professionals' => ['required', 'array', 'min:1'],
            'professionals.*.professional_name' => ['required', 'string', 'max:150'],
            'professionals.*.phone' => ['required', 'string', 'max:50'],
            'professionals.*.email' => ['required', 'email', 'max:255'],
            'professionals.*.profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'professionals.*.existing_profile_image' => ['nullable', 'string', 'max:255'],
            'professionals.*.sede' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'professionals.required' => 'Inserisci almeno un avvocato per la card.',
            'professionals.min' => 'Inserisci almeno un avvocato per la card.',
            'professionals.*.professional_name.required' => 'Il nome dell\'avvocato è obbligatorio.',
            'professionals.*.phone.required' => 'Il telefono dell\'avvocato è obbligatorio.',
            'professionals.*.email.required' => 'L\'email dell\'avvocato è obbligatoria.',
            'professionals.*.email.email' => 'Inserisci un indirizzo email valido per ogni avvocato.',
            'professionals.*.profile_image.image' => 'La foto profilo deve essere un file immagine valido.',
            'professionals.*.profile_image.mimes' => 'La foto profilo deve essere in formato JPG, PNG o WebP.',
            'professionals.*.profile_image.max' => 'La foto profilo non può superare 5 MB.',
            'professionals.*.sede.required' => 'La sede dell\'avvocato è obbligatoria.',
        ];
    }
}
