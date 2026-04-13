<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Solo i campi elencati qui possono essere salvati in massa con Article::create([...])
    protected $fillable = [
        'title',
        'slug',
        'body',
        'category',
        'image',
    ];
}
