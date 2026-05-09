<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'body',
        'reading_time',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'reading_time' => 'integer',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function excerpt(int $length = 160): string
    {
        // 1. Rimuoviamo i tag HTML
        $stripped = strip_tags($this->body);

        // 2. Convertiamo le entità come &nbsp; in spazi reali
        $decoded = html_entity_decode($stripped, ENT_QUOTES, 'UTF-8');

        // 3. (Opzionale ma consigliato) Puliamo eventuali spazi multipli rimasti
        $clean = preg_replace('/\s+/', ' ', $decoded);

        return \Illuminate\Support\Str::limit(trim($clean), $length);
    }
}
