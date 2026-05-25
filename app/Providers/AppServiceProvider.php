<?php

namespace App\Providers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Carbon::setLocale('it');
        Vite::useHotFile(storage_path('vite.hot'));

        View::composer(['components.navbar', 'components.footer'], function ($view) {
            $categories = Cache::remember('nav_categories_v2', now()->addMinutes(10), function () {
                if (!Schema::hasTable('categories')) {
                    return [];
                }

                return Category::query()
                    ->select(['name', 'slug'])
                    ->orderBy('name')
                    ->get()
                    ->filter(function ($category) {
                        return filled($category->slug);
                    })
                    ->map(function ($category) {
                        return [
                            'name' => $category->name,
                            'slug' => $category->slug,
                        ];
                    })
                    ->values()
                    ->all();
            });

            $view->with('navCategories', $categories);
        });
    }
}
