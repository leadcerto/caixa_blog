@extends('layouts.blog')

@section('title', 'Agências Caixa — Imóveis da Caixa')
@section('meta_description', 'Encontre a agência Caixa Econômica Federal mais próxima de você. Endereço, telefone, horário de atendimento e imóveis disponíveis por região.')

@section('content')

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
                Agências Caixa — Imóveis
            </h1>
            <p class="text-lg sm:text-xl text-white/80 max-w-2xl mx-auto">
                Encontre a agência mais próxima e descubra <strong class="text-caixa-orange">imóveis da Caixa</strong> na sua região.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Filtro por bairro --}}
        @if($neighborhoods->count())
            <section class="mb-10">
                <h2 class="text-sm font-semibold uppercase tracking-widest text-text-muted mb-4">Bairros</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($neighborhoods as $n)
                        <a href="#bairro-{{ Str::slug($n->neighborhood) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium bg-surface-muted text-text-secondary hover:bg-caixa-blue-light hover:text-caixa-blue transition-colors">
                            {{ $n->neighborhood }}
                            <span class="bg-black/5 text-text-muted px-1.5 py-0.5 rounded-full text-[10px]">{{ $n->total }}</span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Grid de agências --}}
        @if($agencies->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($agencies as $agency)
                    <a href="{{ route('agencies.show', $agency->slug) }}"
                       id="bairro-{{ Str::slug($agency->neighborhood) }}"
                       class="group bg-surface rounded-2xl border border-border p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 bg-caixa-blue-light rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-caixa-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            @if($agency->average_rating)
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-text-primary">{{ $agency->average_rating }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="font-bold text-text-primary group-hover:text-caixa-blue transition-colors text-sm mb-1">
                            {{ $agency->seo_title }}
                        </h3>
                        <p class="text-xs text-text-secondary mb-1">{{ $agency->address }}</p>
                        <p class="text-xs text-text-muted">{{ $agency->neighborhood }} — {{ $agency->phone }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $agencies->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-text-muted mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h2 class="text-xl font-bold text-text-primary mb-2">Nenhuma agência cadastrada ainda</h2>
                <p class="text-text-secondary">As agências serão exibidas aqui assim que forem cadastradas no painel.</p>
            </div>
        @endif
    </div>

@endsection
