<?php

namespace App\Providers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Carbon::setLocale('it');

        View::composer(['components.navbar', 'components.footer'], function ($view) {
            $categories = collect();
            if (Schema::hasTable('categories')) {
                $categories = Category::orderBy('name')->get();
            }
            $view->with('navCategories', $categories);
        });
    }
}
