<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\RecaptchaRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'intervention_area' => ['required', 'string', 'max:150'],
            'sede' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'company_name' => ['nullable', 'max:0'],
            'g-recaptcha-response' => ['required', 'string', new RecaptchaRule()],
        ];

        Validator::make($input, $rules)->validate();

        return User::create([
            'name' => trim($input['first_name'].' '.$input['last_name']),
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'intervention_area' => $input['intervention_area'],
            'sede' => $input['sede'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
