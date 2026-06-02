@extends('layouts.admin')

@section('admin_title', 'Posts do Blog')

@section('admin_content')

    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Posts do Blog</h1>
            <p class="text-sm text-text-secondary mt-1">Gerencie os artigos educacionais de House Flipping</p>
        </div>
        <a href="{{ route('admin.posts.create') }}"
           class="bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
            + Novo Artigo
        </a>
    </div>

    {{-- Tabela --}}
    @if($posts->count())
        <div class="bg-surface rounded-xl border border-border overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border bg-surface-muted">
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Artigo</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Categoria</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Autor</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Publicado em</th>
                        <th class="text-right px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach($posts as $post)
                        <tr class="hover:bg-surface-muted/40 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-text-primary leading-snug max-w-xs">{{ $post->title }}</p>
                                @if($post->hook_excerpt)
                                    <p class="text-xs text-text-muted mt-0.5 truncate max-w-xs">{{ $post->hook_excerpt }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($post->category)
                                    <span class="inline-block bg-blue-50 text-caixa-blue text-xs font-semibold px-2.5 py-1 rounded-full">
                                        {{ $post->category->name }}
                                    </span>
                                @else
                                    <span class="text-text-muted text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-text-secondary text-xs">
                                {{ $post->author?->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($post->is_published)
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        Publicado
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></span>
                                        Rascunho
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-text-secondary text-xs">
                                {{ $post->published_at?->translatedFormat('d/m/Y') ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    @if($post->is_published)
                                        <a href="{{ route('blog.show', $post->slug) }}"
                                           target="_blank"
                                           class="text-text-muted hover:text-caixa-blue text-xs transition-colors">
                                            Ver artigo
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                       class="text-caixa-blue hover:text-caixa-blue-dark text-xs font-semibold transition-colors">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                          onsubmit="return confirm('Remover este artigo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs transition-colors">
                                            Remover
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        @if($posts->hasPages())
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-16 bg-surface rounded-xl border border-border">
            <svg class="w-12 h-12 text-text-muted mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-text-secondary font-medium">Nenhum artigo criado ainda.</p>
            <a href="{{ route('admin.posts.create') }}" class="inline-block mt-4 bg-caixa-blue text-white font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-caixa-blue-dark transition-colors">
                Criar primeiro artigo
            </a>
        </div>
    @endif

@endsection
