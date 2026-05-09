<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactCard;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Category $category): View
    {
        $articles = $category->articles()
            ->published()
            ->with('author')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        $contactCard = null;

        if (Schema::hasTable('contact_cards')) {
            ContactCard::ensureFixedCards();

            $contactCard = ContactCard::query()
                ->with('professionals')
                ->where('area_name', $category->name)
                ->first();
        }

        return view('categories.show', compact('category', 'articles', 'contactCard'));
    }
}
