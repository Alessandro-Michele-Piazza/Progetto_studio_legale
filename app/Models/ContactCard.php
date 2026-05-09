<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactCard extends Model
{
    public const FIXED_CARDS = [
        'Diritto Civile' => [
            'icon_class' => 'fa-balance-scale',
            'description' => 'Consulenza e assistenza in materia di diritto civile.',
            'professional_name' => 'Avv. Nome Cognome',
            'phone' => '+39 095 000000',
            'email' => 'civile@studiolegale.it',
        ],
        'Diritto Penale' => [
            'icon_class' => 'fa-gavel',
            'description' => 'Difesa e tutela legale in ambito penale.',
            'professional_name' => 'Avv. Nome Cognome',
            'phone' => '+39 095 000001',
            'email' => 'penale@studiolegale.it',
        ],
        'Diritto Amministrativo' => [
            'icon_class' => 'fa-landmark',
            'description' => 'Supporto legale nei rapporti con la pubblica amministrazione.',
            'professional_name' => 'Avv. Nome Cognome',
            'phone' => '+39 095 000002',
            'email' => 'amministrativo@studiolegale.it',
        ],
        'Diritto del Lavoro' => [
            'icon_class' => 'fa-briefcase',
            'description' => 'Assistenza per controversie e consulenza in diritto del lavoro.',
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
                $defaults + ['updated_by' => null]
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
