<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Listagem pública dos posts publicados.
     *
     * Carrega posts com is_published = true, ordenados pelos mais recentes,
     * com Eager Loading de 'category' e 'author' para evitar N+1.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->with(['category', 'author'])
            ->orderByDesc('published_at')
            ->paginate(12);

        $categories = Category::query()
            ->withCount(['posts' => function ($query) {
                $query->where('is_published', true);
            }])
            ->having('posts_count', '>', 0)
            ->orderBy('name')
            ->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    /**
     * Listagem pública dos posts de uma categoria.
     */
    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::query()
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('category_id', $category->id)
            ->with(['author'])
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('blog.category', compact('category', 'posts'));
    }

    /**
     * Exibição de um post individual pelo slug.
     *
     * Carrega 'category', 'author' e 'resources' via Eager Loading.
     * Retorna 404 se o post não existir ou não estiver publicado.
     */
    public function show(string $slug): View
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with(['category', 'author', 'resources'])
            ->firstOrFail();

        // Posts relacionados da mesma categoria (exclui o atual)
        $relatedPosts = Post::query()
            ->where('is_published', true)
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->with(['category', 'author'])
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
