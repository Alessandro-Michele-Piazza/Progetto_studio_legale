<?php

namespace App\Services;

use Illuminate\Support\Str;

class ArticleService
{
    private const WORDS_PER_MINUTE = 200;

    public function calculateReadingTime(string $htmlContent): int
    {
        $text = strip_tags($htmlContent);
        $wordCount = str_word_count($text);

        return max(1, (int) ceil($wordCount / self::WORDS_PER_MINUTE));
    }

    public function generateSlug(string $title): string
    {
        return Str::slug($title);
    }

    public function sanitizeHtml(string $html): string
    {
        $allowed = '<h2><h3><h4><p><br><strong><b><em><i><u><s><a><ul><ol><li><blockquote><pre><code><table><thead><tbody><tr><th><td><img><figure><figcaption><hr>';

        $clean = strip_tags($html, $allowed);

        // Rimuovi attributi pericolosi (on*)
        $clean = preg_replace('/\s+on\w+\s*=\s*["\'][^"\']*["\']/i', '', $clean);

        // Rimuovi javascript: negli href
        $clean = preg_replace('/href\s*=\s*["\']javascript:[^"\']*["\']/i', 'href="#"', $clean);

        return $clean;
    }
}
