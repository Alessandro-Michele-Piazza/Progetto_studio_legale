<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class RecaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $secretKey = config('services.recaptcha.secret_key');

        if (blank($secretKey)) {
            $fail('La configurazione reCAPTCHA non è disponibile. Contatta il supporto.');

            return;
        }

        try {
            $response = Http::asForm()
                ->timeout(8)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secretKey,
                    'response' => (string) $value,
                    'remoteip' => request()->ip(),
                ])
                ->json();
        } catch (\Throwable) {
            $fail('Impossibile verificare il reCAPTCHA. Riprova tra qualche secondo.');

            return;
        }

        if (! is_array($response) || ! ($response['success'] ?? false)) {
            $fail('Verifica reCAPTCHA non valida. Riprova.');
        }
    }
}
