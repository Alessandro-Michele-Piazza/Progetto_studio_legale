<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'body'        => ['required', 'string', 'min:10'],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'publish'     => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Il titolo è obbligatorio.',
            'title.max'            => 'Il titolo non può superare i 255 caratteri.',
            'body.required'        => 'Il contenuto dell\'articolo è obbligatorio.',
            'body.min'             => 'Il contenuto deve avere almeno 10 caratteri.',
            'category_id.required' => 'La categoria è obbligatoria.',
            'category_id.exists'   => 'La categoria selezionata non è valida.',
        ];
    }
}
