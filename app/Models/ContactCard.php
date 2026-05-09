<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $area_name
 * @property string $icon_class
 * @property string $description
 * @property int|null $updated_by
 * @property-read Collection<int, ContactCardProfessional> $professionals
 */
class ContactCard extends Model
{
    public const FIXED_CARDS = [
        'Diritto Civile' => [
            'icon_class' => 'fa-balance-scale',
            'professional_name' => 'Avv. Nome Cognome',
            'phone' => '+39 095 000000',
            'email' => 'civile@studiolegale.it',
        ],
        'Diritto Penale' => [
            'icon_class' => 'fa-gavel',
            'professional_name' => 'Avv. Nome Cognome',
            'phone' => '+39 095 000001',
            'email' => 'penale@studiolegale.it',
        ],
        'Diritto Amministrativo' => [
            'icon_class' => 'fa-landmark',
            'professional_name' => 'Avv. Nome Cognome',
            'phone' => '+39 095 000002',
            'email' => 'amministrativo@studiolegale.it',
        ],
        'Diritto del Lavoro' => [
            'icon_class' => 'fa-briefcase',
            'professional_name' => 'Avv. Nome Cognome',
            'phone' => '+39 095 000003',
            'email' => 'lavoro@studiolegale.it',
        ],
    ];

    protected $fillable = [
        'area_name',
        'icon_class',
        'description',
        'professional_name',
        'phone',
        'email',
        'secondary_professional_name',
        'secondary_phone',
        'secondary_email',
        'updated_by',
    ];

    public function professionals(): HasMany
    {
        return $this->hasMany(ContactCardProfessional::class)->orderBy('sort_order')->orderBy('id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function ensureFixedCards(): void
    {
        foreach (self::FIXED_CARDS as $areaName => $defaults) {
            $card = self::query()->firstOrCreate(
                ['area_name' => $areaName],
                [
                    'icon_class' => $defaults['icon_class'],
                    // Legacy columns are kept in DB schema, but no longer used in UI logic.
                    'description' => '',
                    'professional_name' => $defaults['professional_name'],
                    'phone' => $defaults['phone'],
                    'email' => $defaults['email'],
                    'updated_by' => null,
                ]
            );

            if (! $card->professionals()->exists()) {
                $card->professionals()->create([
                    'professional_name' => $defaults['professional_name'],
                    'phone' => $defaults['phone'],
                    'email' => $defaults['email'],
                    'sede' => 'Sede principale',
                    'sort_order' => 1,
                ]);
            }
        }

        self::query()
            ->whereNotIn('area_name', array_keys(self::FIXED_CARDS))
            ->delete();
    }

    public static function orderedList(): Collection
    {
        $order = array_keys(self::FIXED_CARDS);

        return self::query()
            ->whereIn('area_name', $order)
            ->with('professionals')
            ->get()
            ->sortBy(fn (self $card) => array_search($card->area_name, $order, true))
            ->values();
    }
}
