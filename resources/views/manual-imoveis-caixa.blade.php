@extends('layouts.blog')

@section('title', 'Manual de Compra dos Imóveis da CAIXA | Imóveis da Caixa')
@section('meta_description', 'Manual completo e passo a passo para comprar um imóvel da CAIXA: portal, modalidades de venda, proposta, pagamento, desocupação e prazos.')
@section('canonical_url', route('manual.imoveis'))

@section('whatsapp_float')
<x-whatsapp-float
    image="images/whatsapp/botao-whatsapp.svg"
    phone="5521997882950"
    message="Olá! Gostaria de informações sobre o Manual de Compra dos Imóveis da Caixa."
/>
@endsection

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

    @php
    $manual = [
        [
            'id' => 1,
            'titulo' => 'O Portal de Venda de Imóveis CAIXA',
            'html' => '
                <p>Acesse em <a href="https://www.caixa.gov.br/imoveiscaixa" target="_blank" rel="noopener" class="text-caixa-blue underline">www.caixa.gov.br/imoveiscaixa</a>. Pelo portal você pode:</p>
                <ul class="list-disc list-inside space-y-2 mt-3">
                    <li><strong>Encontrar seu imóvel</strong> — busca por UF, cidade, bairro e características.</li>
                    <li><strong>Efetuar cadastro</strong> — reunir propostas e imóveis favoritos.</li>
                    <li><strong>Fazer uma proposta</strong> — nas modalidades disponíveis.</li>
                    <li><strong>Acessar Editais de Leilão</strong> — para imóveis em Licitação Aberta e/ou 1º e 2º Leilão.</li>
                    <li><strong>Efetuar o pagamento</strong> — conforme condições vigentes.</li>
                </ul>
            ',
        ],
        [
            'id' => 2,
            'titulo' => 'Modalidades de Venda',
            'html' => '
                <div class="space-y-4">
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">1º Leilão SFI</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 9.514/97, art. 27</div>
                            <div><strong>Valor de venda:</strong> valor da garantia atualizada ou avaliação da prefeitura (o maior)</div>
                            <div><strong>Comissão:</strong> 5%, paga pelo arrematante diretamente ao leiloeiro (não compõe o lance)</div>
                            <div><strong>Onde comprar:</strong> site do leiloeiro (conforme edital)</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">2º Leilão SFI</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 9.514/97, art. 27</div>
                            <div><strong>Valor de venda:</strong> total da dívida do contrato + despesas de consolidação</div>
                            <div><strong>Comissão:</strong> 5%, paga ao leiloeiro (não compõe o lance)</div>
                            <div><strong>Onde comprar:</strong> site do leiloeiro</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">Licitação Aberta</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 13.303/2017, art. 28, §3º</div>
                            <div><strong>Valor de venda:</strong> desconto sobre o valor de avaliação atual</div>
                            <div><strong>Comissão:</strong> 5%, paga ao leiloeiro (não compõe o lance)</div>
                            <div><strong>Onde comprar:</strong> site do leiloeiro</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">Venda Online (com cronômetro)</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 13.303/2017, art. 28, §3º</div>
                            <div><strong>Valor de venda:</strong> desconto sobre a avaliação atual</div>
                            <div><strong>Prazo:</strong> verificar no anúncio — vence a maior proposta quando o cronômetro chega a zero</div>
                            <div><strong>Onde comprar:</strong> site da CAIXA</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> intermediação/assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">Compra Direta (sem cronômetro)</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 13.303/2017, art. 28, §3º</div>
                            <div><strong>Valor de venda:</strong> desconto sobre a avaliação atual</div>
                            <div><strong>Prazo:</strong> D+0 — vence a primeira proposta igual ou maior que o valor mínimo</div>
                            <div><strong>Onde comprar:</strong> site da CAIXA</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> intermediação/assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                </div>
            ',
        ],
        [
            'id' => 3,
            'titulo' => 'Como Encontrar Seu Imóvel',
            'html' => '
                <ol class="list-decimal list-inside space-y-2">
                    <li>Clique em "Busque seu imóvel".</li>
                    <li>Selecione estado e cidade (e, se quiser, bairro e modalidade).</li>
                    <li>Os campos de características não são obrigatórios — use-os para refinar a busca.</li>
                    <li>Nos resultados você verá as modalidades: 1º Leilão SFI, 2º Leilão SFI, Compra Direta, Venda Online e Licitação Aberta.</li>
                </ol>
            ',
        ],
        [
            'id' => 4,
            'titulo' => 'Cadastro e Envio da Proposta',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Antes de começar</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Clique em "Fazer uma proposta" para iniciar o cadastro (pessoa física ou jurídica).</li>
                    <li>Após finalizar o cadastro, você volta automaticamente para a proposta do imóvel selecionado.</li>
                    <li>Formas de pagamento possíveis: à vista, financiamento e uso de FGTS (a depender do imóvel).</li>
                </ul>
                <p class="mt-3 text-sm bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-2 rounded-lg">⚠️ <strong>Atenção:</strong> no financiamento, o crédito imobiliário deve estar aprovado antes do registro da proposta. Para usar FGTS, consulte previamente uma agência CAIXA ou correspondente autorizado.</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Login / Cadastro no ambiente CAIXA</h4>
                <p>Faça login ou crie um novo cadastro. Isso garante:</p>
                <ul class="list-disc list-inside space-y-1 mt-2">
                    <li>Praticidade e segurança</li>
                    <li>Proteção de dados</li>
                    <li>Acompanhamento de disputas</li>
                </ul>
                <p class="mt-2">Nesta etapa, só são obrigatórios os campos marcados com asterisco (*).</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Passos da proposta</h4>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Dados do proponente ou representante.</li>
                    <li>Agência de relacionamento e corretor credenciado que intermediou a venda. A intermediação da imobiliária é custeada pela CAIXA. Os corretores ajudam na obtenção de documentos, guias de pagamento, contato com síndico, apoio na desocupação e registro em cartório.</li>
                    <li>Forma de pagamento — campos habilitados conforme as condições do imóvel. O CCA só é liberado se houver valor de financiamento.</li>
                    <li>Dados bancários — para eventual ressarcimento de valores pela CAIXA.</li>
                    <li>Assessoramento da venda (CRECI) — obrigatório se não informado antes. Escolha entre:
                        <ul class="list-disc list-inside mt-1 ml-4 space-y-1">
                            <li><strong>Digital:</strong> escrituração e registro totalmente eletrônicos, sem documentos físicos.</li>
                            <li><strong>Convencional:</strong> todas as imobiliárias habilitadas, independente da forma de escrituração.</li>
                        </ul>
                    </li>
                    <li>Declarações — aceite as condições e clique em "Gravar proposta".</li>
                </ol>
            ',
        ],
        [
            'id' => 5,
            'titulo' => 'Consultando Suas Propostas',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Venda Online (cronômetro ativo):</strong> consulte em "Minhas disputas".</li>
                    <li><strong>Compra Direta e propostas homologadas:</strong> aparecem em "Meus Resultados" → aba "Em andamento".</li>
                    <li><strong>Imóveis pagos e registrados:</strong> ficam em "Meus Imóveis".</li>
                    <li>É possível cancelar a proposta após homologação e antes do pagamento do boleto — ação irreversível.</li>
                    <li>Nesses menus também dá para imprimir a proposta e a matrícula do imóvel.</li>
                </ul>
                <p class="mt-3 text-sm bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded-lg">⏰ <strong>Prazo do boleto:</strong> validade de 2 dias úteis — deve ser impresso e pago para iniciar a contratação.</p>
            ',
        ],
    ];
    @endphp

    {{-- ── ÍNDICE DE NAVEGAÇÃO ──────────────────────────────── --}}
    <nav class="flex flex-wrap gap-2" aria-label="Índice do manual">
        @foreach($manual as $item)
        <a href="#manual-{{ $item['id'] }}" class="text-xs sm:text-sm font-medium text-caixa-blue bg-caixa-blue/5 border border-caixa-blue/20 rounded-full px-3 py-1.5 hover:bg-caixa-blue/10 transition-colors">
            {{ $item['id'] }}. {{ $item['titulo'] }}
        </a>
        @endforeach
    </nav>

    {{-- ── SANFONAS DO MANUAL ───────────────────────────────── --}}
    <div class="space-y-3">
        @foreach($manual as $item)
        <details id="manual-{{ $item['id'] }}" class="bg-surface border border-border rounded-xl overflow-hidden">
            <summary class="flex items-center gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                <span class="summary-icon w-9 h-9 rounded-lg bg-caixa-blue/10 text-caixa-blue font-black text-sm flex items-center justify-center flex-shrink-0 transition-colors">{{ str_pad($item['id'], 2, '0', STR_PAD_LEFT) }}</span>
                <span class="font-semibold text-text-primary flex-1">{{ $item['titulo'] }}</span>
                <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </summary>
            <div class="px-5 pb-5 pt-1 text-text-secondary leading-relaxed prose prose-sm max-w-none">
                {!! $item['html'] !!}
            </div>
        </details>
        @endforeach
    </div>

</div>

@endsection
