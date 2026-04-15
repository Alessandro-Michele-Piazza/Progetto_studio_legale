<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        return view('categories.show', compact('category', 'articles'));
    }
}
