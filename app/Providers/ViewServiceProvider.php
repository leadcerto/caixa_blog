<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * Compartilha dados globais com todas as views que usam o layout do blog.
     */
    public function boot(): void
    {
        // Disponibiliza categorias para o menu de navegação em todas as views
        View::composer('layouts.blog', function ($view) {
            $view->with('navCategories', Category::query()
                ->withCount(['posts' => function ($query) {
                    $query->where('is_published', true);
                }])
                ->orderBy('name')
                ->get()
            );
        });
    }
}
