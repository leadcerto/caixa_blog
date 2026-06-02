@extends('layouts.blog')

@section('title', 'Blog — House Flipping de Imóveis da Caixa')
@section('meta_description', 'Artigos educacionais sobre House Flipping, arrematação, venda direta e licitações de imóveis da Caixa Econômica Federal.')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════════
         HERO / CABEÇALHO DA LISTAGEM
    ═══════════════════════════════════════════════════════════════════ --}}
    <section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
                Blog — House Flipping
            </h1>
            <p class="text-lg sm:text-xl text-white/80 max-w-2xl mx-auto">
                Aprenda tudo sobre arrematação, venda direta e licitações de <strong class="text-caixa-orange">imóveis da Caixa</strong>.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- ═══════════════════════════════════════════════════════════════
             CATEGORIAS EM DESTAQUE
        ═══════════════════════════════════════════════════════════════ --}}
        @if($categories->count())
            <section class="mb-14">
                <h2 class="text-sm font-semibold uppercase tracking-widest text-text-muted mb-5">Explore por Categoria</h2>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('blog.index') }}"
                       class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                              bg-caixa-blue text-white shadow-md">
                        Todos
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog.category', $category->slug) }}"
                           class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200
                                  bg-surface-muted text-text-secondary hover:bg-caixa-blue-light hover:text-caixa-blue">
                            {{ $category->name }}
                            <span class="bg-black/5 text-xs px-2 py-0.5 rounded-full">
                                {{ $category->posts_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ═══════════════════════════════════════════════════════════════
             GRID DE CARDS DOS ARTIGOS
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
                                {{-- Categoria badge --}}
                                @if($post->category)
                                    <span class="inline-block text-xs font-semibold uppercase tracking-wider text-caixa-blue bg-caixa-blue-light px-3 py-1 rounded-full mb-3">
                                        {{ $post->category->name }}
                                    </span>
                                @endif

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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <h2 class="text-xl font-bold text-text-primary mb-2">Nenhum artigo encontrado</h2>
                <p class="text-text-secondary">Novos conteúdos sobre House Flipping estão chegando em breve!</p>
            </div>
        @endif

    </div>

@endsection
