<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactCardProfessional extends Model
{
    protected $fillable = [
        'contact_card_id',
        'professional_name',
        'phone',
        'email',
        'profile_image',
        'sede',
        'sort_order',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(ContactCard::class, 'contact_card_id');
    }
}
