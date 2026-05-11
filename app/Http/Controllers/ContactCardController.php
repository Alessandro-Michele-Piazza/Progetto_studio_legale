<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactCardRequest;
use App\Models\ContactCard;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class ContactCardController extends Controller
{
    private const PROFILE_IMAGE_SIZE = 600;

    public function index(): View
    {
        ContactCard::ensureFixedCards();

        $cards = ContactCard::with('professionals')
            ->orderBy('area_name', 'asc')
            ->get();

        return view('contact-cards.index', compact('cards'));
    }

    public function edit(ContactCard $contactCard): View
    {
        abort_unless(array_key_exists($contactCard->area_name, ContactCard::FIXED_CARDS), 404);

        $contactCard->load('professionals');

        return view('contact-cards.edit', compact('contactCard'));
    }

    public function update(UpdateContactCardRequest $request, ContactCard $contactCard): RedirectResponse
    {
        abort_unless(array_key_exists($contactCard->area_name, ContactCard::FIXED_CARDS), 404);

        $data = $request->validated();

        DB::transaction(function () use ($contactCard, $request, $data): void {
            $existingImagePaths = $contactCard->professionals()
                ->pluck('profile_image')
                ->filter()
                ->values()
                ->all();
            $newImagePaths = [];

            $contactCard->update([
                'updated_by' => $request->user()->id,
            ]);

            $contactCard->professionals()->delete();

            $sortOrder = 1;

            foreach ($data['professionals'] as $index => $professional) {
                $profileImagePath = $professional['existing_profile_image'] ?? null;

                if ($request->hasFile("professionals.$index.profile_image")) {
                    $uploadedImage = $request->file("professionals.$index.profile_image");

                    if ($uploadedImage instanceof UploadedFile) {
                        $profileImagePath = $this->storeProfileImageAsWebp($uploadedImage);
                    }
                }

                if ($profileImagePath !== null && $profileImagePath !== '') {
                    $newImagePaths[] = $profileImagePath;
                }

                $contactCard->professionals()->create([
                    'professional_name' => $professional['professional_name'],
                    'phone' => $professional['phone'],
                    'email' => $professional['email'],
                    'profile_image' => $profileImagePath,
                    'sede' => $professional['sede'],
                    'sort_order' => $sortOrder,
                ]);

                $sortOrder++;
            }

            $pathsToDelete = array_values(array_diff(array_unique($existingImagePaths), array_unique($newImagePaths)));

            if ($pathsToDelete !== []) {
                Storage::disk('public')->delete($pathsToDelete);
            }
        });

        return redirect()
            ->route('contact-cards.index')
            ->with('success', 'Lista Avvocati aggiornata con successo.');
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
