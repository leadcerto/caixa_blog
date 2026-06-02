@extends('layouts.blog')

{{-- SEO CRÍTICO: Title e H1 DEVEM ser idênticos ao título do perfil GMB --}}
@section('title', $agency->seo_title)
@section('meta_description', "Agência Caixa {$agency->name} em {$agency->neighborhood}, {$agency->city}/{$agency->state}. Endereço, telefone, horário de atendimento e avaliações. Encontre imóveis da Caixa nesta região.")
@section('og_type', 'place')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════════
         SCHEMA.ORG — LocalBusiness (Structured Data para SEO Local)
    ═══════════════════════════════════════════════════════════════════ --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "RealEstateAgent",
        "name": "{{ $agency->seo_title }}",
        "description": "Agência Caixa Econômica Federal especializada em imóveis retomados no bairro {{ $agency->neighborhood }}, {{ $agency->city }}/{{ $agency->state }}.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $agency->address }}",
            "addressLocality": "{{ $agency->city }}",
            "addressRegion": "{{ $agency->state }}",
            "postalCode": "{{ $agency->zip_code }}",
            "addressCountry": "BR"
        },
        "telephone": "{{ $agency->phone }}",
        "email": "{{ $agency->email }}",
        "openingHours": "Mo-Fr {{ $agency->opening_hours }}",
        @if($agency->average_rating)
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "{{ $agency->average_rating }}",
            "reviewCount": "{{ $agency->reviews->count() }}"
        },
        @endif
        "url": "{{ route('agencies.show', $agency->slug) }}"
    }
    </script>

    {{-- ═══════════════════════════════════════════════════════════════════
         HERO — Título SEO (H1) em Azul Caixa
    ═══════════════════════════════════════════════════════════════════ --}}
    <section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-14 sm:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-white/60 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Início</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('agencies.index') }}" class="hover:text-white transition-colors">Agências</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white/80">{{ $agency->neighborhood }}</span>
            </nav>

            {{-- Badge de localização --}}
            <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-caixa-orange bg-white/10 px-4 py-1.5 rounded-full mb-5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $agency->neighborhood }}, {{ $agency->state }}
            </span>

            {{-- H1 — Título idêntico ao perfil GMB --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
                {{ $agency->seo_title }}
            </h1>

            {{-- Nota média com estrelas --}}
            @if($agency->average_rating)
                <div class="flex items-center gap-3 mt-4">
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-6 h-6 {{ $i <= round($agency->average_rating) ? 'text-yellow-400' : 'text-white/30' }}" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-white font-bold text-xl">{{ number_format($agency->average_rating, 1, ',', '') }}</span>
                    <span class="text-white/60 text-sm">({{ $agency->reviews->count() }} avaliações)</span>
                </div>
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════════
         DADOS DA AGÊNCIA
    ═══════════════════════════════════════════════════════════════════ --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

            {{-- Card de informações --}}
            <div class="bg-surface rounded-2xl border border-border p-8 space-y-5">
                <h2 class="text-lg font-bold text-caixa-blue flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Agência {{ $agency->name }}
                </h2>

                {{-- Endereço --}}
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-caixa-blue-light rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-caixa-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-text-primary">Endereço</p>
                        <p class="text-sm text-text-secondary">{{ $agency->address }}</p>
                        <p class="text-sm text-text-secondary">{{ $agency->neighborhood }} — {{ $agency->city }}/{{ $agency->state }}</p>
                        <p class="text-sm text-text-muted">CEP: {{ $agency->zip_code }}</p>
                    </div>
                </div>

                {{-- Telefone --}}
                @if($agency->phone)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-caixa-blue-light rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-caixa-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-text-primary">Telefone</p>
                            <a href="tel:{{ preg_replace('/\D/', '', $agency->phone) }}" class="text-sm text-caixa-blue hover:underline">{{ $agency->phone }}</a>
                        </div>
                    </div>
                @endif

                {{-- Email --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-caixa-blue-light rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-caixa-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-text-primary">E-mail</p>
                        <a href="mailto:{{ $agency->email }}" class="text-sm text-caixa-blue hover:underline">{{ $agency->email }}</a>
                    </div>
                </div>

                {{-- Horário --}}
                @if($agency->opening_hours)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-caixa-blue-light rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-caixa-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-text-primary">Horário de Atendimento</p>
                            <p class="text-sm text-text-secondary">{{ $agency->opening_hours }}</p>
                        </div>
                    </div>
                @endif

                {{-- Número da agência --}}
                <div class="pt-3 border-t border-border">
                    <p class="text-xs text-text-muted">Ag. Número: {{ $agency->agency_number }}</p>
                </div>
            </div>

            {{-- Google Maps embed --}}
            <div class="bg-surface rounded-2xl border border-border overflow-hidden">
                <iframe
                    src="https://maps.google.com/maps?q={{ urlencode($agency->address . ', ' . $agency->neighborhood . ', ' . $agency->city . ' - ' . $agency->state . ', ' . $agency->zip_code) }}&t=&z=16&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="100%"
                    style="min-height: 400px; border: 0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Localização da Agência {{ $agency->name }} no Google Maps">
                </iframe>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════════
             CTA — Buscar Imóveis nesta Região (OBRIGATÓRIO)
        ═══════════════════════════════════════════════════════════════ --}}
        <section class="bg-gradient-to-r from-caixa-orange to-caixa-orange-dark rounded-2xl p-8 sm:p-12 text-center shadow-2xl relative overflow-hidden mb-14">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-10 -right-10 w-40 h-40 border-4 border-white rounded-full"></div>
                <div class="absolute -bottom-5 -left-5 w-24 h-24 border-4 border-white rounded-full"></div>
            </div>
            <div class="relative z-10">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3">
                    🏠 Imóveis Disponíveis em {{ $agency->neighborhood }}
                </h2>
                <p class="text-white/90 text-lg mb-8 max-w-lg mx-auto">
                    Encontre imóveis da Caixa com descontos exclusivos nesta região de {{ $agency->city }}.
                </p>
                <a href="https://venda.imoveisdacaixa.com.br"
                   target="_blank"
                   rel="noopener"
                   class="inline-flex items-center gap-3 bg-white text-caixa-orange font-extrabold text-lg px-10 py-5 rounded-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:bg-gray-50">
                    Ver Imóveis Disponíveis nesta Agência
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════════
             PROVA SOCIAL — Avaliações do Google
        ═══════════════════════════════════════════════════════════════ --}}
        <section class="mb-14">
            <h2 class="text-2xl font-bold text-text-primary mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-caixa-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Avaliações dos Clientes
                </h2>

                @if($agency->reviews->count())
                <div class="space-y-4">
                    @foreach($agency->reviews as $review)
                        <div class="bg-surface rounded-xl border border-border p-6">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-caixa-blue-light rounded-full flex items-center justify-center">
                                        <span class="text-caixa-blue font-bold text-sm">{{ strtoupper(substr($review->reviewer_name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-text-primary text-sm">{{ $review->reviewer_name }}</p>
                                        <p class="text-xs text-text-muted">{{ $review->review_date?->translatedFormat('d \d\e F \d\e Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>

                            @if($review->comment)
                                <p class="text-text-secondary text-sm leading-relaxed">{{ $review->comment }}</p>
                            @endif

                            @if($review->reply)
                                <div class="mt-4 bg-caixa-blue-light rounded-lg p-4 border-l-4 border-caixa-blue">
                                    <p class="text-xs font-semibold text-caixa-blue mb-1">Resposta da Equipe</p>
                                    <p class="text-sm text-text-primary">{{ $review->reply }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                @else
                <div class="bg-surface-muted rounded-xl border border-border p-8 text-center">
                    <svg class="w-10 h-10 text-text-muted mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p class="text-text-secondary font-medium">Nenhuma avaliação ainda.</p>
                    <p class="text-text-muted text-sm mt-1">Seja o primeiro a avaliar esta agência no Google.</p>
                </div>
                @endif
            </section>

        {{-- ═══════════════════════════════════════════════════════════════
             AGÊNCIAS PRÓXIMAS — Link interno para SEO
        ═══════════════════════════════════════════════════════════════ --}}
        @if($nearbyAgencies->count())
            <section>
                <h2 class="text-2xl font-bold text-text-primary mb-6">Outras Agências em {{ $agency->city }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($nearbyAgencies as $nearby)
                        <a href="{{ route('agencies.show', $nearby->slug) }}"
                           class="group bg-surface rounded-xl border border-border p-5 hover:shadow-lg hover:border-caixa-blue transition-all duration-200">
                            <p class="font-bold text-text-primary group-hover:text-caixa-blue transition-colors text-sm">
                                {{ $nearby->seo_title }}
                            </p>
                            <p class="text-xs text-text-secondary mt-1">{{ $nearby->address }}</p>
                            <p class="text-xs text-text-muted mt-1">{{ $nearby->neighborhood }}</p>
                            @if($nearby->average_rating)
                                <div class="flex items-center gap-1 mt-2">
                                    <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <span class="text-xs font-medium text-text-secondary">{{ $nearby->average_rating }}</span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>

@endsection
