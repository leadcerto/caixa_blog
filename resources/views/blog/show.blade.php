@extends('layouts.blog')

@section('title', $post->title . ' — Imóveis da Caixa')
@section('meta_description', $post->hook_excerpt ?? Str::limit(strip_tags($post->content), 160))
@section('og_type', 'article')
@section('og_image', $post->featured_image ? asset('storage/' . $post->featured_image) : '')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════════
         CABEÇALHO DO ARTIGO — Título Magnético (H1) em Azul Caixa
    ═══════════════════════════════════════════════════════════════════ --}}
    <section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-14 sm:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-white/60 mb-6">
                <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                @if($post->category)
                    <a href="{{ route('blog.category', $post->category->slug) }}" class="hover:text-white transition-colors">{{ $post->category->name }}</a>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                @endif
                <span class="text-white/80 truncate">{{ $post->title }}</span>
            </nav>

            {{-- Categoria badge --}}
            @if($post->category)
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-caixa-orange bg-white/10 px-4 py-1.5 rounded-full mb-5">
                    {{ $post->category->name }}
                </span>
            @endif

            {{-- H1 — Título Magnético --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
                {{ $post->title }}
            </h1>

            {{-- Meta do autor + data --}}
            <div class="flex items-center gap-4 text-white/70 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span class="font-medium text-white">{{ $post->author->name ?? 'Redação' }}</span>
                </div>
                <span class="text-white/40">•</span>
                <time datetime="{{ $post->published_at?->toISOString() }}">
                    {{ $post->published_at?->translatedFormat('d \d\e F \d\e Y') ?? '' }}
                </time>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════════
         IMAGEM DE CAPA (featured_image)
    ═══════════════════════════════════════════════════════════════════ --}}
    @if($post->featured_image)
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
            <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title }}"
                     class="w-full h-auto object-cover max-h-[500px]">
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════════════════
         CORPO DO ARTIGO (Container restrito para leitura)
    ═══════════════════════════════════════════════════════════════════ --}}
    <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- ── GANCHO / HOOK ────────────────────────────────────────── --}}
        @if($post->hook_excerpt)
            <div class="bg-surface-muted border-l-4 border-caixa-blue rounded-r-xl p-6 mb-10">
                <p class="text-lg sm:text-xl text-text-primary font-medium leading-relaxed italic">
                    {{ $post->hook_excerpt }}
                </p>
            </div>
        @endif

        {{-- ── CONTEÚDO PRINCIPAL (Listicles / Rich Text) ───────────── --}}
        <div class="prose prose-lg max-w-none
                    prose-headings:text-caixa-blue prose-headings:font-bold
                    prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4 prose-h2:border-b prose-h2:border-border prose-h2:pb-3
                    prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                    prose-p:text-text-primary prose-p:leading-relaxed
                    prose-a:text-caixa-blue prose-a:font-medium prose-a:underline prose-a:decoration-caixa-orange/50 hover:prose-a:decoration-caixa-orange
                    prose-strong:text-text-primary
                    prose-ul:my-4 prose-li:text-text-primary
                    prose-img:rounded-xl prose-img:shadow-lg
                    prose-blockquote:border-l-caixa-orange prose-blockquote:bg-caixa-orange-light prose-blockquote:rounded-r-xl prose-blockquote:py-1">
            {!! $post->content !!}
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             ÁREA DE RECURSOS — Downloads Disponíveis
        ═══════════════════════════════════════════════════════════ --}}
        @if($post->resources->count())
            <section class="mt-14 bg-surface-alt border border-border rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-caixa-blue-light rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-caixa-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-text-primary">📥 Downloads Disponíveis</h3>
                        <p class="text-sm text-text-secondary">Materiais complementares para este artigo</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach($post->resources as $resource)
                        <a href="{{ asset('storage/' . $resource->file_path) }}"
                           target="_blank"
                           rel="noopener"
                           class="flex items-center gap-4 p-4 bg-surface rounded-xl border border-border hover:border-caixa-blue hover:shadow-md transition-all duration-200 group">

                            {{-- Ícone do tipo --}}
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center
                                        {{ $resource->type === 'pdf' ? 'bg-red-50 text-red-500' : '' }}
                                        {{ $resource->type === 'template' ? 'bg-green-50 text-green-600' : '' }}
                                        {{ !in_array($resource->type, ['pdf', 'template']) ? 'bg-caixa-blue-light text-caixa-blue' : '' }}">
                                @if($resource->type === 'pdf')
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                @else
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M6 20h12a2 2 0 002-2V8l-6-6H6a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-text-primary group-hover:text-caixa-blue transition-colors truncate">
                                    {{ $resource->title }}
                                </p>
                                <p class="text-xs text-text-muted uppercase tracking-wider mt-0.5">
                                    {{ strtoupper($resource->type) }}
                                </p>
                            </div>

                            <svg class="w-5 h-5 text-text-muted group-hover:text-caixa-blue transition-colors flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ═══════════════════════════════════════════════════════════
             CTA FINAL — Buscar Imóveis da Caixa Agora (OBRIGATÓRIO)
        ═══════════════════════════════════════════════════════════ --}}
        <section class="mt-16 bg-gradient-to-r from-caixa-orange to-caixa-orange-dark rounded-2xl p-8 sm:p-12 text-center shadow-2xl relative overflow-hidden">
            {{-- Padrão decorativo --}}
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-10 -right-10 w-40 h-40 border-4 border-white rounded-full"></div>
                <div class="absolute -bottom-5 -left-5 w-24 h-24 border-4 border-white rounded-full"></div>
            </div>

            <div class="relative z-10">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3">
                    🏠 Encontre Seu Imóvel Agora
                </h2>
                <p class="text-white/90 text-lg mb-8 max-w-lg mx-auto">
                    Acesse nossa plataforma exclusiva e descubra oportunidades de imóveis da Caixa com preços abaixo do mercado.
                </p>
                <a href="https://venda.imoveisdacaixa.com.br"
                   target="_blank"
                   rel="noopener"
                   class="inline-flex items-center gap-3 bg-white text-caixa-orange font-extrabold text-lg px-10 py-5 rounded-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:bg-gray-50">
                    Buscar Imóveis da Caixa Agora
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </section>

    </article>

    {{-- ═══════════════════════════════════════════════════════════════════
         POSTS RELACIONADOS
    ═══════════════════════════════════════════════════════════════════ --}}
    @if($relatedPosts->count())
        <section class="bg-surface-alt border-t border-border py-14">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-text-primary mb-8">Artigos Relacionados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $related)
                        <article class="group bg-surface rounded-2xl border border-border overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                            <a href="{{ route('blog.show', $related->slug) }}" class="block aspect-video overflow-hidden bg-surface-muted">
                                @if($related->featured_image)
                                    <img src="{{ asset('storage/' . $related->featured_image) }}"
                                         alt="{{ $related->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-caixa-blue-light to-surface-muted">
                                        <svg class="w-10 h-10 text-caixa-blue/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z" />
                                        </svg>
                                    </div>
                                @endif
                            </a>
                            <div class="p-5">
                                @if($related->category)
                                    <span class="inline-block text-xs font-semibold uppercase tracking-wider text-caixa-blue bg-caixa-blue-light px-2.5 py-0.5 rounded-full mb-2">{{ $related->category->name }}</span>
                                @endif
                                <h3 class="text-base font-bold text-text-primary leading-snug line-clamp-2 group-hover:text-caixa-blue transition-colors">
                                    <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                </h3>
                                <p class="text-xs text-text-muted mt-2">{{ $related->published_at?->translatedFormat('d M, Y') }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
