<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->with(['category', 'author'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'nullable|exists:categories,id',
            'hook_excerpt'   => 'nullable|string|max:500',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'is_published'   => 'nullable|boolean',
        ]);

        $validated['slug']      = $this->generateUniqueSlug($validated['title']);
        $validated['author_id'] = auth()->id();
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artigo criado com sucesso.');
    }

    public function edit(Post $post): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'nullable|exists:categories,id',
            'hook_excerpt'   => 'nullable|string|max:500',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'is_published'   => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        // Define published_at apenas na primeira publicação
        if ($validated['is_published'] && ! $post->published_at) {
            $validated['published_at'] = now();
        } elseif (! $validated['is_published']) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('featured_image')) {
            // Remove a imagem anterior se existir
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artigo atualizado com sucesso.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artigo removido com sucesso.');
    }

    private function generateUniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
