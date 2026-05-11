<?php

namespace App\Models;

use App\Notifications\VerifyEmailCustom;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\ProfessionalProfile;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'first_name', 'last_name', 'intervention_area', 'sede', 'contact_notes', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function professionalProfile(): HasOne
    {
        return $this->hasOne(ProfessionalProfile::class);
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailCustom);
    }
}
