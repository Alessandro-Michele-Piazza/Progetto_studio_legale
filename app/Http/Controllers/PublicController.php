<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function homepage(): View
    {
        $categories = collect();
        $latestArticles = collect();

        if (Schema::hasTable('categories')) {
            $categories = Category::orderBy('name')->get();
        }

        if (Schema::hasTable('articles') && Schema::hasTable('categories')) {
            $latestArticles = Article::published()
                ->with(['category', 'author'])
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('welcome', compact('categories', 'latestArticles'));
    }

    public function contact(): View
    {
        return view('contatti');
    }
}
