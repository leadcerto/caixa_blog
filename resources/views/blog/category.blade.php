@extends('layouts.blog')

@section('title', $category->name . ' — Blog | Imóveis da Caixa')
@section('meta_description', $category->description ?? 'Artigos sobre ' . $category->name . ' — House Flipping e imóveis da Caixa Econômica Federal.')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════════
         HERO DA CATEGORIA
    ═══════════════════════════════════════════════════════════════════ --}}
    @if($category->slug === 'flipping-imobiliario')
    {{-- ── Hero Premium: Flipping Imobiliário ──────────────────────────── --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 py-20 sm:py-28 overflow-hidden">
        {{-- Padrão decorativo de fundo --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-caixa-blue rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="mb-8">
                <ol class="flex items-center gap-2 text-sm text-white/50">
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a></li>
                    <li class="text-white/30">/</li>
                    <li class="text-white/80 font-medium">{{ $category->name }}</li>
                </ol>
            </nav>

            <div class="max-w-3xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    Estratégia de Alta Rentabilidade
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                    {{ $category->name }}
                </h1>

                @if($category->description)
                    <p class="text-xl text-white/70 leading-relaxed mb-8">
                        {{ $category->description }}
                    </p>
                @endif

                {{-- Métricas de destaque --}}
                <div class="flex flex-wrap gap-6 mb-6">
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Comprar abaixo do mercado
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Vender rápido com margem
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        Imóveis da Caixa com desconto
                    </div>
                </div>

                <p class="text-white/40 text-sm">
                    {{ $posts->total() }} {{ $posts->total() === 1 ? 'artigo encontrado' : 'artigos encontrados' }}
                </p>
            </div>
        </div>
    </section>
    @else
    {{-- ── Hero Padrão ──────────────────────────────────────────────────── --}}
    <section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
    @endif

    {{-- ═══════════════════════════════════════════════════════════════════
         GRID DE CARDS (comum a todos os heroes)
    ═══════════════════════════════════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

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
                                <h2 class="text-lg font-bold text-text-primary leading-snug mb-2 line-clamp-2 group-hover:text-caixa-blue transition-colors">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                @if($post->hook_excerpt)
                                    <p class="text-text-secondary text-sm leading-relaxed mb-4 line-clamp-3">
                                        {{ $post->hook_excerpt }}
                                    </p>
                                @endif

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

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </section>
        @else
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
