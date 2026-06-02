<?php

use App\Http\Controllers\AgencyPublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AgencyController as AdminAgencyController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/venda-imoveis-caixa', fn() => view('venda-imoveis-caixa'))->name('venda.imoveis');
Route::get('/politica-de-privacidade', fn() => view('politica-de-privacidade'))->name('privacidade');
Route::post('/contato', [ContactController::class, 'store'])->name('contato.store');


// Blog público
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/categoria/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// SEO Local — Agências (Google Meu Negócio)
Route::get('/imoveis_caixa', [AgencyPublicController::class, 'index'])->name('agencies.index');
Route::get('/imoveis_caixa/{slug}', [AgencyPublicController::class, 'show'])->name('agencies.show');

/*
|--------------------------------------------------------------------------
| Dashboard (Breeze)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Perfil do Usuário (Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rotas Admin (autenticadas)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // CRUD de Posts (Blog)
    Route::resource('posts', AdminPostController::class);

    // CRUD de Categorias (Blog)
    Route::resource('categories', AdminCategoryController::class);

    // CRUD de Agências
    Route::resource('agencies', AdminAgencyController::class);

    // Gestão de Reviews
    Route::get('agencies/{agency}/reviews', [AdminAgencyController::class, 'reviews'])
        ->name('agencies.reviews');
    Route::post('agencies/{agency}/reviews/{review}/reply', [AdminAgencyController::class, 'replyToReview'])
        ->name('agencies.reviews.reply');
});

require __DIR__ . '/auth.php';
