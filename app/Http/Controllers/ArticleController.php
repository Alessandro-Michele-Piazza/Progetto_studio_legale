<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Services\ArticleService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class ArticleController extends Controller implements HasMiddleware
{
    public function __construct(
        private readonly ArticleService $articleService
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show', 'byCategory']),
        ];
    }

    public function index(Request $request): View
    {
        return $this->renderListing($request);
    }

    public function byCategory(Request $request, Category $category): View
    {
        return $this->renderListing($request, $category);
    }

    public function show(Article $article): View
    {
        $article->load(['author', 'category']);

        return view('articles.show', compact('article'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $authors = User::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('articles.create', compact('categories', 'authors'));
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $author = User::query()->findOrFail($validated['author_id']);

        $sanitizedBody = $this->articleService->sanitizeHtml($validated['body']);

        $article = $author->articles()->create([
            'title'        => $validated['title'],
            'slug'         => $this->articleService->generateSlug($validated['title']),
            'body'         => $sanitizedBody,
            'category_id'  => $validated['category_id'],
            'reading_time' => $this->articleService->calculateReadingTime($sanitizedBody),
            'published_at' => now(),
        ]);

        return redirect()->route('articoli.show', $article)->with('success', 'Articolo pubblicato con successo.');
    }

    public function edit(Article $article): View
    {
        $categories = Category::orderBy('name')->get();

        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $validated = $request->validated();

        $sanitizedBody = $this->articleService->sanitizeHtml($validated['body']);

        $data = [
            'title'        => $validated['title'],
            'slug'         => $this->articleService->generateSlug($validated['title']),
            'body'         => $sanitizedBody,
            'category_id'  => $validated['category_id'],
            'reading_time' => $this->articleService->calculateReadingTime($sanitizedBody),
        ];

        if ($request->boolean('publish') && ! $article->published_at) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('articoli.show', $article)
            ->with('success', 'Articolo aggiornato con successo.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('articoli.index')
            ->with('success', 'Articolo eliminato con successo.');
    }

    private function renderListing(Request $request, ?Category $category = null): View
    {
        $activePublicationYear = $request->string('publication_year')->toString();
        $activeAuthorId = $request->string('author_id')->toString();
        $activeSearch = $request->string('search')->toString();

        $articlesQuery = $this->basePublishedArticlesQuery($category)
            ->with(['author', 'category']);

        if ($activePublicationYear !== '') {
            $articlesQuery->whereYear('published_at', (int) $activePublicationYear);
        }

        if ($activeAuthorId !== '') {
            $articlesQuery->where('user_id', (int) $activeAuthorId);
        }

        if ($activeSearch !== '') {
            $articlesQuery->where(function (Builder $q) use ($activeSearch) {
                $q->where('title', 'like', '%' . $activeSearch . '%')
                  ->orWhere('body', 'like', '%' . $activeSearch . '%');
            });
        }

        $articles = $articlesQuery
            ->orderByDesc('published_at')
            ->paginate(9)
            ->withQueryString();

        $availableCategories = Category::query()
            ->whereHas('articles', fn (Builder $query) => $query->published())
            ->orderBy('name')
            ->get();

        $availablePublicationYears = $this->basePublishedArticlesQuery($category)
            ->orderByDesc('published_at')
            ->pluck('published_at')
            ->map(fn ($publishedAt) => (int) date('Y', strtotime($publishedAt)))
            ->unique()
            ->values();

        $availableAuthors = User::query()
            ->whereHas('articles', function (Builder $query) use ($category) {
                $query->published();

                if ($category !== null) {
                    $query->where('category_id', $category->id);
                }
            })
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('articles.index', compact(
            'articles',
            'category',
            'availableCategories',
            'availablePublicationYears',
            'availableAuthors',
            'activePublicationYear',
            'activeAuthorId',
            'activeSearch',
        ));
    }

    private function basePublishedArticlesQuery(?Category $category = null): Builder
    {
        $query = Article::query()->published();

        if ($category !== null) {
            $query->where('category_id', $category->id);
        }

        return $query;
    }
}
