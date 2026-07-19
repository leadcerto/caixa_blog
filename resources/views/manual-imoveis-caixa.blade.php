@extends('layouts.blog')

@section('title', 'Manual de Compra dos Imóveis da CAIXA | Imóveis da Caixa')
@section('meta_description', 'Manual completo e passo a passo para comprar um imóvel da CAIXA: portal, modalidades de venda, proposta, pagamento, desocupação e prazos.')
@section('canonical_url', route('manual.imoveis'))

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-xs font-bold uppercase tracking-widest text-amber-300 mb-4">Guia Oficial</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight mb-6">
            Manual de Compra dos Imóveis da <span class="text-caixa-orange">CAIXA</span>
        </h1>
        <a href="https://venda.imoveisdacaixa.com.br/"
           target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 bg-caixa-orange hover:bg-orange-600 text-white font-bold text-lg px-8 py-4 rounded-xl transition-colors">
            Busca de Imóveis →
        </a>
    </div>
</section>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">

</div>

@endsection
