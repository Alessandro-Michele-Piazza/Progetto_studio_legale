<?php

namespace App\Actions\Fortify;

use App\Models\ContactCard;
use App\Models\User;
use App\Rules\RecaptchaRule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    private const PROFILE_IMAGE_SIZE = 600;

    /**
     * Validate and create a newly registered user.
     *
      * @param  array<string, mixed>  $input
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
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'company_name' => ['nullable', 'max:0'],
            'g-recaptcha-response' => ['required', 'string', new RecaptchaRule()],
        ];

        Validator::make($input, $rules)->validate();

        $user = User::create([
            'name' => trim($input['first_name'].' '.$input['last_name']),
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'intervention_area' => $input['intervention_area'],
            'sede' => $input['sede'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $profileImageInput = $input['profile_image'] ?? null;

        if ($profileImageInput instanceof UploadedFile) {
            $profileImagePath = $this->storeProfileImageAsWebp($profileImageInput);

            ContactCard::ensureFixedCards();

            $contactCard = ContactCard::query()
                ->where('area_name', $user->intervention_area)
                ->first();

            if ($contactCard !== null) {
                $existingProfessional = $contactCard->professionals()
                    ->where('email', $user->email)
                    ->first();

                if ($existingProfessional !== null) {
                    $oldProfileImagePath = $existingProfessional->profile_image;

                    $contactCard->professionals()
                        ->where('email', $user->email)
                        ->update([
                        'professional_name' => $user->name,
                        'sede' => $user->sede,
                        'profile_image' => $profileImagePath,
                        ]);

                    if (! empty($oldProfileImagePath) && $oldProfileImagePath !== $profileImagePath) {
                        Storage::disk('public')->delete($oldProfileImagePath);
                    }
                } else {
                    $nextSortOrder = ((int) $contactCard->professionals()->max('sort_order')) + 1;

                    $contactCard->professionals()->create([
                        'professional_name' => $user->name,
                        'phone' => '',
                        'email' => $user->email,
                        'profile_image' => $profileImagePath,
                        'sede' => $user->sede,
                        'sort_order' => $nextSortOrder,
                    ]);
                }
            }
        }

        return $user;
    }

    private function storeProfileImageAsWebp(UploadedFile $uploadedImage): string
    {
        $imageManager = new ImageManager(new Driver());
        $encodedImage = $imageManager
            ->decode($uploadedImage->getRealPath())
            ->orient()
            ->cover(self::PROFILE_IMAGE_SIZE, self::PROFILE_IMAGE_SIZE)
            ->encode(new WebpEncoder(quality: 82));

        $path = 'avvocati/' . Str::uuid()->toString() . '.webp';

        Storage::disk('public')->put($path, $encodedImage->toString());

        return $path;
    }
}
