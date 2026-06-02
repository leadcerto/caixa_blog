@extends('layouts.blog')

@section('title', $category->name . ' — Blog | Imóveis da Caixa')
@section('meta_description', $category->description ?? 'Artigos sobre ' . $category->name . ' — House Flipping e imóveis da Caixa Econômica Federal.')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════════
         HERO DA CATEGORIA
    ═══════════════════════════════════════════════════════════════════ --}}
    <section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="mb-6">
                <ol class="flex items-center gap-2 text-sm text-white/60">
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a></li>
                    <li class="text-white/40">/</li>
                    <li class="text-white/90 font-medium">{{ $category->name }}</li>
                </ol>
            </nav>

            <div class="max-w-3xl">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-caixa-orange mb-4">Categoria</span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
                    {{ $category->name }}
                </h1>
                @if($category->description)
                    <p class="text-lg text-white/80 leading-relaxed">
                        {{ $category->description }}
                    </p>
                @endif
                <p class="text-white/50 text-sm mt-4">
                    {{ $posts->total() }} {{ $posts->total() === 1 ? 'artigo encontrado' : 'artigos encontrados' }}
                </p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- ═══════════════════════════════════════════════════════════════
             GRID DE CARDS
        ═══════════════════════════════════════════════════════════════ --}}
        @if($posts->count())
            <section>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="group bg-surface rounded-2xl border border-border overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                            {{-- Imagem de capa --}}
                            <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video overflow-hidden bg-surface-muted">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-caixa-blue-light to-surface-muted">
                                        <svg class="w-12 h-12 text-caixa-blue/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z" />
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            {{-- Conteúdo do card --}}
                            <div class="p-6">
                                {{-- Título --}}
                                <h2 class="text-lg font-bold text-text-primary leading-snug mb-2 line-clamp-2 group-hover:text-caixa-blue transition-colors">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                {{-- Hook / Excerpt --}}
                                @if($post->hook_excerpt)
                                    <p class="text-text-secondary text-sm leading-relaxed mb-4 line-clamp-3">
                                        {{ $post->hook_excerpt }}
                                    </p>
                                @endif

                                {{-- Meta (autor + data) --}}
                                <div class="flex items-center justify-between text-xs text-text-muted pt-4 border-t border-border">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $post->author->name ?? 'Redação' }}
                                    </span>
                                    <time datetime="{{ $post->published_at?->toISOString() }}">
                                        {{ $post->published_at?->translatedFormat('d M, Y') ?? '' }}
                                    </time>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Paginação --}}
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </section>
        @else
            {{-- Estado vazio --}}
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-text-muted mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                </svg>
                <h2 class="text-xl font-bold text-text-primary mb-2">Nenhum artigo nesta categoria ainda</h2>
                <p class="text-text-secondary mb-6">Os artigos de <strong>{{ $category->name }}</strong> estão chegando em breve.</p>
                <a href="{{ route('blog.index') }}"
                   class="inline-flex items-center gap-2 bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-6 py-3 rounded-xl transition-colors">
                    ← Ver todos os artigos
                </a>
            </div>
        @endif

    </div>

@endsection
