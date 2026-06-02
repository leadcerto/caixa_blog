<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = Cache::remember('sitemap.xml', now()->addHours(24), function () {
            $posts = Post::query()
                ->where('is_published', true)
                ->whereNotNull('published_at')
                ->select(['slug', 'updated_at', 'published_at'])
                ->orderByDesc('published_at')
                ->get();

            $categories = Category::query()
                ->select(['slug', 'updated_at'])
                ->orderBy('name')
                ->get();

            return view('sitemap', compact('posts', 'categories'))->render();
        });

        return response($xml, 200)
            ->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
