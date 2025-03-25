<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.layouts.header', function ($view) {
            $categories = Category::all(); // Fetch all categories
            $view->with('categories', $categories);
        });

        View::composer('frontend.layouts.footer', function ($view) {
            $categories = Category::all(); // Fetch all categories
            $view->with('categories', $categories);
        });
    }
}
