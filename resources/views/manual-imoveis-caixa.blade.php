@extends('layouts.blog')

@section('title', 'Manual de Compra dos Imóveis da CAIXA — Guia Completo | Imóveis da Caixa')
@section('meta_description', 'Guia completo para comprar Imóveis da CAIXA: até 70% de desconto, entrada de 5%, modalidades de venda, perguntas frequentes e manual passo a passo — do portal à desocupação do imóvel.')
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
        <p class="text-lg sm:text-xl text-white/90 max-w-3xl mx-auto mb-8">
            Imóveis com até <strong class="text-white">70% de desconto</strong>, entrada de apenas <strong class="text-white">5%</strong>, sem comissão de corretor e com assessoria gratuita. Saiba tudo aqui.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="https://venda.imoveisdacaixa.com.br/"
               target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 bg-caixa-orange hover:bg-orange-600 text-white font-bold text-lg px-8 py-4 rounded-xl transition-colors">
                Busca de Imóveis →
            </a>
            <a href="#cadastro"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold text-lg px-8 py-4 rounded-xl transition-colors">
                Quero ser atendido gratuitamente →
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     MACRO SEÇÕES  (cada uma com sua própria coleção de sanfonas)
═══════════════════════════════════════════════════════════ --}}
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">


    {{-- ── 1. O QUE É + BENEFÍCIOS ─────────────────────────── --}}
    <section>
        <h2 class="text-2xl font-extrabold text-text-primary mb-6 pb-3 border-b-2 border-caixa-blue">
            O que é a Venda de Imóveis da CAIXA?
        </h2>
        <div class="space-y-3">

            @php $items1 = [
                ['O que é a Venda de Imóveis da CAIXA?', '
                    <p>A Venda de Imóveis da CAIXA é a grande oportunidade de pessoas comprarem sua casa própria e de investidores terem alto lucro com a compra e venda desses imóveis.</p>
                    <p class="mt-3">Os imóveis da CAIXA são imóveis que um dia alguém comprou e por falta de pagamento o banco recebeu o imóvel de volta em troca da quitação da dívida existente.</p>
                    <p class="mt-3 font-semibold text-caixa-blue">Só aqui você consegue comprar imóveis financiados com 70% de desconto, com entrada reduzida de apenas 5%, sem pagar comissão de leiloeiro e de corretagem.</p>
                '],
                ['Descontos Agressivos', '
                    <p>A grande maioria dos Imóveis CAIXA estão com <strong>mais de 40% de desconto</strong>. Temos imóveis com até <strong>95% mais baratos</strong> que o preço de venda normal.</p>
                '],
                ['Entrada Reduzida — apenas 5%', '
                    <p>Na compra de um imóvel comum você precisa de 30% do valor. Nos Imóveis CAIXA você precisa de <strong>apenas 5%</strong>. Exclusivo para Imóveis CAIXA.</p>
                '],
                ['Corretagem GRÁTIS', '
                    <p>Somente imobiliárias cadastradas podem comercializar esses imóveis e <strong>quem paga o corretor é a CAIXA</strong>. Mais uma vantagem na compra do seu imóvel.</p>
                '],
                ['Financiamento CAIXA', '
                    <p>Até <strong>95% financiado pela CAIXA</strong> com condições especiais e análise de crédito gratuita e online.</p>
                '],
                ['Maior Estoque do Brasil', '
                    <p>Mais de <strong>35.000 imóveis disponíveis</strong> para venda em todo o Brasil. Todos os dias entram imóveis novos.</p>
                '],
                ['Dívidas ZERO', '
                    <p>A CAIXA paga todas as despesas de condomínio e IPTU do imóvel <strong>até a data da venda</strong>.</p>
                '],
            ]; @endphp

            @foreach($items1 as $item)
            <details class="bg-surface border border-border rounded-xl overflow-hidden group">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                    <span class="font-semibold text-text-primary">{{ $item[0] }}</span>
                    <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-text-secondary leading-relaxed prose prose-sm max-w-none">
                    {!! $item[1] !!}
                </div>
            </details>
            @endforeach
        </div>
    </section>


    {{-- ── 2. PERGUNTAS FREQUENTES ──────────────────────────── --}}
    <section>
        <h2 class="text-2xl font-extrabold text-text-primary mb-6 pb-3 border-b-2 border-caixa-blue">
            Perguntas Frequentes
        </h2>
        <div class="space-y-3">

            {{-- Atendimento --}}
            <details class="bg-surface border border-border rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                    <span class="font-semibold text-text-primary">Como funciona o atendimento inicial?</span>
                    <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-text-secondary leading-relaxed">
                    <ol class="list-decimal list-inside space-y-3">
                        <li><strong>Aprovação de Crédito</strong> — Verifique se está com nome limpo e reúna seus documentos: identidade, CPF e endereço completo com CEP.</li>
                        <li><strong>Escolha do imóvel</strong> — Preencha o formulário de abertura de atendimento e escolha o imóvel de interesse. Um corretor analisará suas informações.</li>
                        <li><strong>Reunião com o Corretor</strong> — O Corretor Credenciado vai entrar em contato pelo WhatsApp, tirar dúvidas e ajudar em todo o processo.</li>
                    </ol>
                    <p class="mt-3 text-sm bg-green-50 text-green-800 px-4 py-2 rounded-lg border border-green-200">✅ Esse atendimento é gratuito — não é cobrada nenhuma comissão de assessoria na venda direta.</p>
                </div>
            </details>

            {{-- Quem pode comprar --}}
            @php $faqComprar = [
                ['É possível comprar tendo restrições no nome?', 'Em qualquer contrato de crédito, a análise de crédito é critério fundamental. Se você possui restrições no nome, como dívidas em aberto ou inadimplência, isso afetará sua capacidade de obter financiamento e a aprovação será negada.'],
                ['Quais fatores influenciam a análise de crédito?', 'Diversas variáveis podem influenciar: o valor do imóvel, sua renda e o prazo do financiamento.'],
                ['Qual o valor máximo de prestação?', 'Em geral, o valor das parcelas não deve ultrapassar 30% da renda mensal. Se sua renda é R$4.000, as parcelas não devem ultrapassar R$1.200/mês.'],
                ['Quais documentos são necessários?', '<ul class="list-disc list-inside space-y-1"><li>Documento de identificação com foto (RG ou CNH)</li><li>CPF</li><li>Comprovante de residência</li><li>Comprovante de estado civil</li><li>Comprovante de renda</li><li>Extrato do FGTS (se utilizado)</li><li>Certidão negativa de débitos municipais, estaduais e federais</li><li>Certidão de matrícula atualizada do imóvel</li></ul>'],
            ]; @endphp
            <div class="border border-border rounded-xl overflow-hidden">
                <div class="bg-caixa-blue/5 px-5 py-3 border-b border-border">
                    <span class="text-sm font-bold text-caixa-blue uppercase tracking-wide">Quem pode comprar</span>
                </div>
                <div class="divide-y divide-border">
                    @foreach($faqComprar as $faq)
                    <details class="bg-surface">
                        <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                            <span class="font-medium text-text-primary text-sm">{{ $faq[0] }}</span>
                            <svg class="chevron w-4 h-4 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="px-5 pb-4 pt-1 text-text-secondary text-sm leading-relaxed">{!! $faq[1] !!}</div>
                    </details>
                    @endforeach
                </div>
            </div>

            {{-- Sobre os imóveis --}}
            @php $faqImoveis = [
                ['Posso agendar visita interna ao imóvel?', 'Fornecemos o endereço do imóvel e você pode ir ao local, porém não é possível visitar a parte interna nem o condomínio.'],
                ['O imóvel está ocupado?', 'O fato de estar ocupado não deve ser impedimento. Temos casos em que o imóvel foi desocupado de forma amigável. Caso necessário, é possível entrar com ação judicial de imissão de posse — em até 90 dias o imóvel estará desocupado.'],
                ['Há garantia de ausência de cobranças pendentes?', 'Nos imóveis de venda direta, as dívidas de IPTU e condomínio são pagas pela CAIXA. No caso dos imóveis comprados em leilão, é preciso fazer uma busca prévia de todas as dívidas e ler o edital.'],
                ['Qual o segredo para ser tão barato?', 'Alguém já pagou parte do valor e, por algum motivo, deixou de pagar. O banco retoma o imóvel e precisa vendê-lo rapidamente — pois o negócio do banco é dinheiro, não imóveis. Por isso oferece descontos agressivos.'],
                ['Quantos imóveis a CAIXA tem disponíveis?', 'Todos os dias a CAIXA realiza novos financiamentos e ao mesmo tempo novos imóveis são retomados. O estoque é atualizado diariamente em todo o Brasil.'],
            ]; @endphp
            <div class="border border-border rounded-xl overflow-hidden">
                <div class="bg-caixa-blue/5 px-5 py-3 border-b border-border">
                    <span class="text-sm font-bold text-caixa-blue uppercase tracking-wide">Sobre os Imóveis da CAIXA</span>
                </div>
                <div class="divide-y divide-border">
                    @foreach($faqImoveis as $faq)
                    <details class="bg-surface">
                        <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                            <span class="font-medium text-text-primary text-sm">{{ $faq[0] }}</span>
                            <svg class="chevron w-4 h-4 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="px-5 pb-4 pt-1 text-text-secondary text-sm leading-relaxed">{!! $faq[1] !!}</div>
                    </details>
                    @endforeach
                </div>
            </div>

            {{-- Formas de pagamento --}}
            @php $faqPagamento = [
                ['Quais as formas de pagamento?', 'À vista, financiamento e uso de FGTS, a depender do imóvel. Exclusivamente nos casos de financiamento, é fundamental a aprovação do crédito imobiliário antes do registro da proposta.'],
                ['Qual o prazo para pagar a entrada de 5%?', 'O valor é pago de imediato para garantir a compra. Organize-se financeiramente antes de fazer uma proposta — lembre-se que também será preciso cobrir as despesas de documentação.'],
                ['É possível usar FGTS para dar entrada?', 'Sim, porém é necessário analisar cada caso para saber se está disponível para saque e qual valor pode ser utilizado. Verifique também se o imóvel aceita essa forma de pagamento.'],
                ['Posso financiar com outro banco?', 'Você pode, porém perderá os benefícios e descontos oferecidos pela CAIXA.'],
                ['Qual o prazo máximo de financiamento?', 'O prazo máximo é de 35 anos. A idade máxima é de 80 anos — ou seja, com 50 anos você pode financiar por no máximo 30 anos.'],
                ['Qual a taxa de juros da CAIXA?', 'O SFH financia imóveis até R$1,5 milhão com taxas a partir de 6,5% ao ano. Para imóveis acima desse valor, o SFI é utilizado. O Minha Casa Minha Vida oferece condições diferenciadas para baixa renda.'],
                ['Preciso ter conta na CAIXA?', 'Não é obrigatório, mas facilita o processo. Caso não seja cliente, será necessário abrir uma conta após a compra para as operações financeiras do financiamento.'],
            ]; @endphp
            <div class="border border-border rounded-xl overflow-hidden">
                <div class="bg-caixa-blue/5 px-5 py-3 border-b border-border">
                    <span class="text-sm font-bold text-caixa-blue uppercase tracking-wide">Formas de Pagamento e Financiamento</span>
                </div>
                <div class="divide-y divide-border">
                    @foreach($faqPagamento as $faq)
                    <details class="bg-surface">
                        <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                            <span class="font-medium text-text-primary text-sm">{{ $faq[0] }}</span>
                            <svg class="chevron w-4 h-4 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="px-5 pb-4 pt-1 text-text-secondary text-sm leading-relaxed">{!! $faq[1] !!}</div>
                    </details>
                    @endforeach
                </div>
            </div>

        </div>
    </section>


    {{-- ── 3. DÉBITOS PÓS-VENDA ─────────────────────────────── --}}
    <section>
        <h2 class="text-2xl font-extrabold text-text-primary mb-2 pb-3 border-b-2 border-orange-400">
            ⚠️ Débitos Pós-Venda
        </h2>
        <p class="text-sm text-text-secondary mb-6">Regras atualizadas em 24/janeiro/2025</p>
        <div class="space-y-3">

            <details class="border-2 border-red-200 bg-red-50 rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-red-100 transition-colors">
                    <span class="font-semibold text-red-800">❌ O que a CAIXA NÃO paga</span>
                    <svg class="chevron w-5 h-5 text-red-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-red-900 text-sm leading-relaxed">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Taxa de incêndio</li>
                        <li>Despesas cartoriais e de despachante</li>
                        <li>Desocupação do imóvel</li>
                        <li>Consertos e reformas</li>
                        <li>IPTU e Condomínio dos imóveis comprados <strong>em leilão</strong></li>
                    </ul>
                </div>
            </details>

            <details class="border-2 border-green-200 bg-green-50 rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-green-100 transition-colors">
                    <span class="font-semibold text-green-800">✅ O que a CAIXA PAGA (Venda Direta e Licitação Aberta)</span>
                    <svg class="chevron w-5 h-5 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-green-900 text-sm leading-relaxed space-y-3">
                    <p><strong>IPTU:</strong> Débitos até R$1.000 são de responsabilidade do comprador. Acima disso, a CAIXA quita.</p>
                    <p><strong>Condomínio (regra 1):</strong> O comprador paga até 10% do valor de avaliação do imóvel. O excedente é quitado integralmente pela CAIXA.<br>
                    <em>Exemplo: Imóvel avaliado em R$500.000 → comprador paga até R$50.000; o restante a CAIXA quita.</em></p>
                    <p><strong>Condomínio (regra 2):</strong> A CAIXA paga todas as dívidas de condomínio. Verifique no anúncio do imóvel qual regra se aplica.</p>
                    <p class="text-xs text-green-700 bg-green-100 px-3 py-2 rounded">⚠️ A CAIXA se responsabiliza apenas pelas dívidas de condomínio dos últimos 5 anos, salvo as que estão em processos judiciais.</p>
                </div>
            </details>

        </div>
    </section>


    {{-- ── 4. GUIA COMPLETO ─────────────────────────────────── --}}
    <section>
        <h2 class="text-2xl font-extrabold text-text-primary mb-6 pb-3 border-b-2 border-caixa-blue">
            Guia Completo de Compra
        </h2>
        <div class="space-y-3">

            @php $guia = [
                ['01', 'Conhecendo os Imóveis da CAIXA', '
                    <p>Os imóveis da CAIXA são imóveis que estão sendo retomados pela CAIXA porque o financiamento não foi pago, de acordo com a Lei de Alienação Fiduciária. O banco leva esse imóvel a leilão para quitar a dívida.</p>
                    <p class="mt-2">Esse é um leilão extrajudicial — não envolve processo judicial. Você não precisa de advogado; toda orientação é dada pelos leiloeiros e imobiliárias credenciadas.</p>
                    <p class="mt-2 font-medium text-caixa-blue">Como alguém já pagou parte do valor desse imóvel e o banco não tem interesse em mantê-lo, a CAIXA coloca esse imóvel com um preço muito menor que o mercado tradicional.</p>
                '],
                ['02', 'Como são vendidos os Imóveis da CAIXA?', '
                    <ol class="list-decimal list-inside space-y-2">
                        <li><strong>1º Leilão:</strong> Valor mínimo = valor do contrato atualizado. Comprador responsável pelas dívidas.</li>
                        <li><strong>2º Leilão:</strong> Valor mínimo = total das dívidas do contrato. Comprador responsável pelas dívidas.</li>
                        <li><strong>Venda Direta:</strong> Se não vendido nos leilões, a CAIXA retoma e vende nas modalidades que desejar, quitando IPTU e Condomínio.</li>
                    </ol>
                '],
                ['03', 'Características dos Imóveis da CAIXA', '
                    <ul class="space-y-2 text-sm">
                        <li><strong>Localização:</strong> Milhares de imóveis em cidades de todo o Brasil.</li>
                        <li><strong>Tipos:</strong> Casas, apartamentos, terrenos, lojas e salas comerciais — novos e usados.</li>
                        <li><strong>Visitação:</strong> É possível ir ao local e ver o exterior, mas não a parte interna.</li>
                        <li><strong>Estado:</strong> Vendido no estado em que se encontra — reformas são por conta do comprador.</li>
                        <li><strong>Tomada de Posse:</strong> O novo proprietário executa todo o processo de imissão de posse.</li>
                        <li><strong>Financiamento:</strong> Até 95% do valor, sujeito a aprovação de crédito prévia.</li>
                        <li><strong>Documentação:</strong> Toda documentada. Despesas de cartório, impostos e despachante são por conta do comprador.</li>
                    </ul>
                '],
                ['04', 'Passo a Passo para Compra sem Estresse', '
                    <ol class="list-decimal list-inside space-y-2 text-sm">
                        <li>A imobiliária aprova seu crédito e ajuda no planejamento financeiro.</li>
                        <li>A imobiliária envia o link de busca de imóveis.</li>
                        <li>Você passa para a imobiliária as informações do imóvel desejado.</li>
                        <li>A imobiliária tira dúvidas sobre o imóvel e a modalidade de compra.</li>
                        <li>A imobiliária faz a proposta de compra com o corretor e o correspondente bancário.</li>
                        <li>Você paga o boleto do valor de entrada e comunica a imobiliária.</li>
                        <li>A imobiliária providencia a regularização dos documentos até o imóvel ser matriculado no seu nome.</li>
                        <li>A imobiliária orienta os pagamentos de IPTU e condomínio anteriores à compra.</li>
                        <li>A imobiliária envia à CAIXA a matrícula atualizada com o novo proprietário.</li>
                    </ol>
                '],
                ['05', 'As 10 Vantagens de Comprar um Imóvel da CAIXA', '
                    <ol class="list-decimal list-inside space-y-2 text-sm">
                        <li>Imóvel totalmente documentado — fácil de vender futuramente.</li>
                        <li>Menor entrada do mercado: apenas 5% (vs 30-50% em imóveis comuns).</li>
                        <li>Imóveis vendidos muito abaixo do preço de mercado.</li>
                        <li>CAIXA paga as dívidas de condomínio e IPTU anteriores à venda.</li>
                        <li>Financiamento de até 95% exclusivo para imóveis da CAIXA.</li>
                        <li>Sem comissão de venda — imóvel entregue livre de dívidas.</li>
                        <li>Entrada de apenas 5% (novamente destaque).</li>
                        <li>Use o FGTS para reduzir o financiamento e ter parcelas menores.</li>
                        <li>Valor de aluguel frequentemente maior que a parcela do financiamento.</li>
                        <li>Milhares de imóveis — estoque atualizado todos os dias.</li>
                    </ol>
                '],
                ['06', 'As 2 Desvantagens (e como superá-las)', '
                    <div class="space-y-4 text-sm">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <strong class="text-yellow-800">1. Não poder visitar internamente</strong>
                            <p class="mt-1 text-yellow-700">Você pode ir ao local, ver o exterior e, se for apartamento, visitar outro do mesmo prédio para ter noção de planta e tamanho.</p>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <strong class="text-yellow-800">2. Desocupação do imóvel</strong>
                            <p class="mt-1 text-yellow-700">Nossa equipe tem conseguido desocupar em até 60 dias (grande maioria em menos de 30 dias). Custo: 5% do valor do imóvel ou mínimo de R$10.000.</p>
                        </div>
                    </div>
                '],
            ]; @endphp

            @foreach($guia as $item)
            <details class="bg-surface border border-border rounded-xl overflow-hidden">
                <summary class="flex items-center gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                    <span class="summary-icon w-9 h-9 rounded-lg bg-caixa-blue/10 text-caixa-blue font-black text-sm flex items-center justify-center flex-shrink-0 transition-colors">{{ $item[0] }}</span>
                    <span class="font-semibold text-text-primary flex-1">{{ $item[1] }}</span>
                    <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-text-secondary leading-relaxed">{!! $item[2] !!}</div>
            </details>
            @endforeach

        </div>
    </section>


    {{-- ── 5. MODALIDADES DE VENDA ──────────────────────────── --}}
    <section>
        <h2 class="text-2xl font-extrabold text-text-primary mb-6 pb-3 border-b-2 border-caixa-blue">
            Modalidades de Venda
        </h2>
        <div class="space-y-3">

            @php $modalidades = [
                ['1º Leilão SFI', 'border-red-200 bg-red-50/30', 'text-red-700', '
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div><strong>Lei:</strong> 9.514/97 art 27</div>
                        <div><strong>Comissão:</strong> 5% paga pelo arrematante ao leiloeiro</div>
                        <div><strong>Valor mínimo:</strong> Valor da garantia atualizada ou avaliação da prefeitura (o maior)</div>
                        <div><strong>IPTU/Condomínio:</strong> ❌ Não pagos pela CAIXA</div>
                        <div><strong>Onde comprar:</strong> Site do leiloeiro (indicado no edital)</div>
                    </div>
                    <div class="bg-red-100 text-red-800 text-sm p-3 rounded-lg">
                        ⚠️ <strong>Recomendação:</strong> Não indicado para iniciantes. Verifique se o site do leiloeiro é legítimo e leia o edital com atenção. Para iniciantes, prefira as modalidades de Venda Direta.
                    </div>
                '],
                ['2º Leilão SFI', 'border-red-200 bg-red-50/30', 'text-red-700', '
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div><strong>Lei:</strong> 9.514/97 art 27</div>
                        <div><strong>Comissão:</strong> 5% paga pelo arrematante ao leiloeiro</div>
                        <div><strong>Valor mínimo:</strong> Total da dívida do contrato + despesas</div>
                        <div><strong>IPTU/Condomínio:</strong> ❌ Não pagos pela CAIXA</div>
                        <div><strong>Onde comprar:</strong> Site do leiloeiro (indicado no edital)</div>
                    </div>
                    <div class="bg-red-100 text-red-800 text-sm p-3 rounded-lg">
                        ⚠️ <strong>Recomendação:</strong> Também não indicado para iniciantes pelas mesmas razões do 1º Leilão.
                    </div>
                '],
                ['Licitação Aberta', 'border-yellow-200 bg-yellow-50/30', 'text-yellow-700', '
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div><strong>Lei:</strong> 13.303/2017 art. 28 §3º</div>
                        <div><strong>Comissão:</strong> 5% paga pelo arrematante ao leiloeiro</div>
                        <div><strong>Valor:</strong> Desconto sobre o valor de avaliação atual</div>
                        <div><strong>IPTU/Condomínio:</strong> ✅ Quitados pela CAIXA</div>
                        <div><strong>Onde comprar:</strong> Site do leiloeiro (indicado no edital)</div>
                    </div>
                    <div class="bg-yellow-100 text-yellow-800 text-sm p-3 rounded-lg">
                        ⚠️ Ainda envolve leiloeiro. Verifique a autenticidade do site antes de participar.
                    </div>
                '],
                ['Venda Online ⭐ Recomendada', 'border-green-200 bg-green-50/30', 'text-green-700', '
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div><strong>Lei:</strong> 13.303/2017 art. 28 §3º</div>
                        <div><strong>Comissão:</strong> ✅ Sem comissão de leiloeiro</div>
                        <div><strong>Valor:</strong> Desconto sobre o valor de avaliação atual</div>
                        <div><strong>IPTU/Condomínio:</strong> ✅ Quitados pela CAIXA</div>
                        <div><strong>Onde comprar:</strong> Portal da CAIXA (www.caixa.gov.br/imoveiscaixa)</div>
                        <div><strong>Encerramento:</strong> Cronômetro regressivo — vence a maior proposta quando zera</div>
                    </div>
                    <div class="bg-green-100 text-green-800 text-sm p-3 rounded-lg">
                        ✅ <strong>Mais indicada para moradia ou investimento.</strong> Compra feita direto no portal da CAIXA, sem risco de sites falsos e sem pagar comissão de leiloeiro.
                    </div>
                '],
                ['Venda Direta Online ⭐⭐ Mais Indicada', 'border-caixa-blue bg-blue-50/30', 'text-caixa-blue', '
                    <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                        <div><strong>Lei:</strong> 13.303/2017 art. 28 §3º</div>
                        <div><strong>Comissão:</strong> ✅ Sem comissão de leiloeiro</div>
                        <div><strong>Valor:</strong> Desconto sobre o valor de avaliação atual</div>
                        <div><strong>IPTU/Condomínio:</strong> ✅ Quitados pela CAIXA</div>
                        <div><strong>Onde comprar:</strong> <a href="https://www.caixa.gov.br/imoveiscaixa" target="_blank" class="text-caixa-blue underline">www.caixa.gov.br/imoveiscaixa</a></div>
                        <div><strong>Prazo:</strong> D+0 — vence a primeira proposta igual ou maior que o valor mínimo</div>
                    </div>
                    <div class="bg-blue-100 text-caixa-blue text-sm p-3 rounded-lg">
                        ✅ <strong>A modalidade mais segura e mais indicada.</strong> Compra direta no portal oficial da CAIXA, sem leiloeiro, sem comissão e com IPTU/Condomínio quitados.
                    </div>
                '],
            ]; @endphp

            @foreach($modalidades as $mod)
            <details class="border-2 {{ $mod[1] }} rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:opacity-90 transition-opacity">
                    <span class="font-semibold {{ $mod[2] }}">{{ $mod[0] }}</span>
                    <svg class="chevron w-5 h-5 {{ $mod[2] }} flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-2 text-text-secondary leading-relaxed">{!! $mod[3] !!}</div>
            </details>
            @endforeach

        </div>
    </section>


    {{-- ── 6. ASSESSORIA GRATUITA ───────────────────────────── --}}
    <section>
        <h2 class="text-2xl font-extrabold text-text-primary mb-6 pb-3 border-b-2 border-caixa-blue">
            Assessoria Gratuita — Corretor Credenciado CAIXA
        </h2>
        <div class="space-y-3">

            <details class="bg-surface border border-border rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                    <span class="font-semibold text-text-primary">O que o Corretor CAIXA faz ANTES do pagamento da entrada</span>
                    <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-text-secondary text-sm leading-relaxed">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Orienta sobre despesas adicionais e processo de compra</li>
                        <li>Orienta sobre obtenção de crédito e uso do FGTS</li>
                        <li>Orienta a levantar débitos do imóvel e documentos para quitação</li>
                        <li>Orienta a emitir matrícula atualizada e certidão de ônus do imóvel</li>
                        <li>Auxilia na pesquisa de ações judiciais incidentes sobre o imóvel</li>
                    </ul>
                    <p class="mt-3 text-xs text-text-muted">⚠️ O Corretor não é o despachante do cliente. Despesas de cartório e despachante são por conta do cliente.</p>
                </div>
            </details>

            <details class="bg-surface border border-border rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                    <span class="font-semibold text-text-primary">O que o Corretor CAIXA faz na Venda e Pós-Venda</span>
                    <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-text-secondary text-sm leading-relaxed">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Confere a minuta e acompanha a assinatura do contrato de financiamento</li>
                        <li>Auxilia na averbação dos leilões negativos, se necessário</li>
                        <li>Auxilia no registro de compra e venda junto à prefeitura</li>
                        <li>Orienta sobre procedimentos de desocupação extrajudicial</li>
                        <li>Orienta o cliente na apresentação da nova matrícula e transferência do IPTU</li>
                    </ul>
                    <p class="mt-3 text-xs text-text-muted">⚠️ Nem a CAIXA, nem a imobiliária, nem o corretor possuem obrigação quanto à imissão de posse. Cabe exclusivamente ao novo proprietário tomar as devidas providências.</p>
                </div>
            </details>

            <details class="bg-surface border border-border rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                    <span class="font-semibold text-text-primary">Quanto custa a assessoria do corretor credenciado?</span>
                    <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-text-secondary text-sm leading-relaxed">
                    <p class="font-semibold text-green-700 text-base">✅ GRATUITO — é o banco que paga a comissão dos corretores.</p>
                    <p class="mt-2">Na Venda de Imóveis da CAIXA, o banco realiza o pagamento dos valores de comissão, gerando mais economia para o cliente.</p>
                </div>
            </details>

            <details class="bg-surface border border-border rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                    <span class="font-semibold text-text-primary">Como indicar nossa imobiliária no cadastro da CAIXA?</span>
                    <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-text-secondary text-sm leading-relaxed">
                    <p>No seu cadastro na CAIXA, no campo de indicação de interesse de compra, informe os dados da nossa imobiliária:</p>
                    <div class="mt-3 bg-caixa-blue/5 border border-caixa-blue/20 rounded-lg p-4">
                        <p><strong>Imóveis da Caixa</strong></p>
                        <p>CNPJ: <strong>50.563.863/0001-45</strong></p>
                    </div>
                </div>
            </details>

        </div>
    </section>


    {{-- ── 7. ESPECIALISTA ──────────────────────────────────── --}}
    <section>
        <h2 class="text-2xl font-extrabold text-text-primary mb-6 pb-3 border-b-2 border-caixa-blue">
            Quem está por trás deste guia
        </h2>
        <div class="bg-surface border border-border rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row gap-6 items-start">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-caixa-blue to-blue-800 flex items-center justify-center flex-shrink-0">
                <span class="text-white font-black text-2xl">LL</span>
            </div>
            <div>
                <h3 class="text-xl font-extrabold text-text-primary">Leonardo Leão</h3>
                <p class="text-caixa-blue font-semibold text-sm mb-3">Especialista em Imóveis da CAIXA · Perito Judicial TJ/RJ · CEO – Imóveis da Caixa</p>
                <p class="text-text-secondary leading-relaxed">
                    Após 22 anos no mercado imobiliário, decidi ajudar as pessoas a desvendar os mistérios na hora de comprar um imóvel de propriedade da CAIXA. Centenas de milionários tentam esconder essa informação para que só eles sejam beneficiados.
                </p>
                <p class="text-text-secondary leading-relaxed mt-2">
                    Neste guia apresento um passo a passo de boas práticas para que você compre seu imóvel para morar ou investir. É a maneira mais barata de comprar um imóvel — mas é diferente da compra tradicional, por isso você precisa se preparar.
                </p>
            </div>
        </div>
    </section>


    {{-- ── DIVISOR: INÍCIO DO MANUAL PASSO A PASSO ──────────── --}}
    <section>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-text-primary text-center pb-3 mb-2">
            Manual de Compra — Passo a Passo Completo
        </h2>
        <p class="text-text-secondary text-center max-w-2xl mx-auto">
            Do portal oficial da CAIXA até a desocupação do imóvel: veja o passo a passo completo, seção por seção.
        </p>
    </section>

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
        [
            'id' => 6,
            'titulo' => 'Alterando Sua Proposta',
            'html' => '
                <p>Em "Meus Resultados" é possível alterar composição de valores, participantes e agência de contratação.</p>
                <ul class="list-disc list-inside space-y-2 mt-3">
                    <li>Campos de Financiamento/FGTS só são liberados se o imóvel aceitar.</li>
                    <li><strong>Passo 2 — Proponentes:</strong> incluir/excluir participantes (só cadastrados no ambiente CAIXA). Pode-se mudar para Pessoa Jurídica se a empresa estiver cadastrada e o proponente constar como sócio na Receita Federal. O proponente principal não pode ser excluído.</li>
                    <li><strong>Passo 4 — Valores:</strong> a composição pode mudar, mas não o valor global da proposta.</li>
                    <li>Pode-se alterar a agência de contratação.</li>
                </ul>
                <div class="mt-3 text-sm bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
                    <strong>⚠️ Atenção:</strong>
                    <ul class="list-disc list-inside mt-1 space-y-1">
                        <li>Em Leilão, não é possível alterar, incluir ou excluir proponentes — todos devem ser informados no ato da arrematação.</li>
                        <li>A alteração da proposta não prorroga o prazo de pagamento. Fique atento à validade do boleto.</li>
                    </ul>
                </div>
            ',
        ],
        [
            'id' => 7,
            'titulo' => 'Próximos Passos Após a Compra',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">À vista</h4>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Pagar o boleto em até 2 dias úteis.</li>
                    <li>Ir à agência CAIXA escolhida para retirar documentos da Escritura.</li>
                    <li>Registrar a transferência em Cartório e trocar a titularidade junto à Prefeitura.</li>
                </ol>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Financiamento e uso de FGTS</h4>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Pagar o boleto em até 2 dias úteis.</li>
                    <li>Levar ao Correspondente CAIXA (CCA) ou agência os documentos:
                        <ul class="list-disc list-inside mt-1 ml-4 space-y-1">
                            <li>Proposta e boleto impressos + comprovante de pagamento</li>
                            <li>Documento de identificação</li>
                            <li>Comprovante de residência</li>
                            <li>Comprovante de estado civil e regime de bens</li>
                            <li>Comprovante de renda atualizado (últimos 2 meses)</li>
                            <li>Declaração de Imposto de Renda</li>
                            <li>Simulação da operação</li>
                            <li>Documentos complementares solicitados</li>
                        </ul>
                    </li>
                    <li>Com o crédito aprovado e/ou FGTS liberado, assina-se o contrato.</li>
                    <li>Registrar o contrato em Cartório e trocar a titularidade junto à Prefeitura.</li>
                </ol>
            ',
        ],
        [
            'id' => 8,
            'titulo' => 'Visita e Situação do Imóvel',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li>Não há como saber previamente se o imóvel está ocupado. Na maioria dos casos, o ocupante desocupa sem problemas após notificação.</li>
                    <li>Você pode ir ao local sondar a situação, mas a CAIXA não autoriza a entrada no imóvel antes da compra.</li>
                    <li>Vale conhecer a região — uma alternativa prática é usar o Google Maps para uma visão ampla.</li>
                    <li>A desocupação só pode começar após o registro do imóvel e a baixa da compra, seguindo as regras da lei.</li>
                </ul>
            ',
        ],
        [
            'id' => 9,
            'titulo' => 'Desocupação do Imóvel',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li>Estar ocupado não é impedimento — há muitos casos de desocupação amigável.</li>
                    <li>Em leilão extrajudicial, o processo comum é:
                        <ol class="list-decimal list-inside mt-1 ml-4 space-y-1">
                            <li>Tentar acordo amigável via notificação extrajudicial.</li>
                            <li>Se não houver saída, ingressar com ação de imissão na posse.</li>
                        </ol>
                    </li>
                    <li>A lei garante ao arrematante o direito à imissão judicial, com possível liminar de desocupação em 60 dias, desde que a consolidação da propriedade esteja comprovada e o imóvel registrado em nome do arrematante.</li>
                </ul>
            ',
        ],
        [
            'id' => 10,
            'titulo' => 'Formas de Pagamento Aceitas',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Recursos próprios</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Boleto gerado automaticamente, a pagar em até 3 dias.</li>
                    <li>Disponível para download no sistema da CAIXA (também enviamos pelo WhatsApp).</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Uso de FGTS</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Faça análise prévia do valor disponível para saque e informe o valor na proposta.</li>
                    <li>É preciso já saber seu enquadramento e o valor liberado para compra.</li>
                    <li>Mesmo com FGTS maior que o preço, é obrigatório pagar no mínimo 5% em dinheiro (boleto); até 95% pode ser FGTS.</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Financiamento SBPE</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Só aparece na ficha se o imóvel aceitar financiamento.</li>
                    <li>Só faça proposta se não tiver pendências de crédito.</li>
                    <li>Faça análise prévia de aprovação de crédito antes da proposta (orientação da CAIXA).</li>
                    <li>Informe o valor de entrada (mínimo 5%) + saldo financiado.</li>
                    <li>Se financiamento + 5% não atingir o valor de compra, aumente a entrada até igualar o valor de venda.</li>
                    <li>Se a opção não aparece na ficha, o imóvel não permite financiamento — não há filtro de busca para isso, então continue procurando outro que informe aceitar financiamento.</li>
                </ul>
            ',
        ],
        [
            'id' => 11,
            'titulo' => 'Financiamento Imobiliário — Requisitos e Documentos',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Requisitos</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Sem restrição de crédito</li>
                    <li>Renda comprovada</li>
                    <li>Valor em dinheiro para entrada + valor para pagar a documentação do imóvel</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Documentação</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Documentação pessoal</li>
                    <li>Comprovantes de renda</li>
                    <li>Extrato bancário das contas</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Observações importantes</h4>
                <p>Precisamos saber o valor disponível em dinheiro para definir o teto do imóvel. Quanto menor o percentual financiado, maior o desconto na taxa de juros.</p>
                <p class="mt-2">O FGTS não serve como entrada — ele abate o saldo devedor e diminui o valor financiado.</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Pré-aprovação obrigatória</h4>
                <p>A CAIXA exige pré-aprovação de crédito antes da proposta. Tratamos disso pelo WhatsApp; após a aprovação, você recebe um código para preencher no formulário de proposta.</p>
            ',
        ],
        [
            'id' => 12,
            'titulo' => 'Despesas de Compra',
            'html' => '
                <p>Há dois tipos: condomínio e tributos + registro do imóvel.</p>
                <ul class="list-disc list-inside space-y-2 mt-3">
                    <li><strong>Leilão:</strong> comprador paga a comissão do leiloeiro e todas as despesas de condomínio e tributos (confira o edital).</li>
                    <li><strong>Licitação Aberta:</strong> comprador paga parte das despesas de condomínio e o total de tributos (confira a ficha).</li>
                    <li><strong>Venda Direta:</strong> conforme a ficha do imóvel — geralmente a CAIXA paga parte ou toda a dívida de condomínio/tributos (confira a ficha).</li>
                    <li><strong>Em todas as modalidades:</strong> o registro do imóvel é do comprador, que deve enviar cópia de RGI e IPTU em até 60 dias para a baixa de compra.</li>
                </ul>
            ',
        ],
        [
            'id' => 13,
            'titulo' => 'Regras de Despesas de Condomínio',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li>Responsabilidade do comprador até 10% do valor de avaliação do imóvel.</li>
                    <li>A CAIXA paga apenas o que exceder esse limite de 10%.</li>
                    <li>Não temos o valor exato das dívidas — solicite à administradora.</li>
                    <li>Investidores costumam reservar 10% do débito nas custas do investimento.</li>
                    <li>Na prática, o comprador pode negociar com a administradora; o que passar de 10% a CAIXA paga integralmente após envio do RGI e IPTU em nome do comprador.</li>
                </ul>
                <p class="mt-3 text-sm bg-caixa-blue/5 border border-caixa-blue/20 px-4 py-3 rounded-lg">
                    <strong>Exemplo:</strong> imóvel avaliado em R$ 253.000,00 → despesa máxima de condomínio para o comprador é R$ 25.300,00 (o excedente a CAIXA paga). A dívida de IPTU de R$ 4.535,00 é de responsabilidade do comprador.
                </p>
            ',
        ],
        [
            'id' => 14,
            'titulo' => 'Despesas de Tributos e IPTU',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Regra geral</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Todas as despesas de tributos são do comprador (confira sempre na proposta).</li>
                    <li>Abrange IPTU, taxa de incêndio, laudêmio e outros — o foco principal é o IPTU.</li>
                    <li>Todas as dívidas de IPTU são de responsabilidade do comprador em todas as modalidades.</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Inscrição imobiliária</h4>
                <p>Com esse número, consulte no site da prefeitura eventuais dívidas de IPTU e valores.</p>
                <p class="mt-2">Se não constar na ficha, o comprador deve buscar diretamente na prefeitura para saber dívidas, imprimir documentação e alterar a titularidade do IPTU.</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Quando a inscrição imobiliária não é informada — Rio de Janeiro</h4>
                <p>Buscar na Secretaria de Fazenda nos pontos:</p>
                <ul class="list-disc list-inside space-y-1 mt-2">
                    <li><strong>Centro:</strong> Rua Afonso Cavalcanti, 455 – prédio anexo – térreo</li>
                    <li><strong>Barra Shopping:</strong> Av. das Américas, 4.666 – Entrada A, lojas 215/216</li>
                    <li><strong>West Shopping:</strong> Estrada do Mendanha, 555 – Campo Grande – Loja 282</li>
                    <li><strong>Norte Shopping:</strong> Av. Dom Helder Câmara, 5474 – Loja 3021 – Cachambi</li>
                </ul>
            ',
        ],
        [
            'id' => 15,
            'titulo' => 'Prazos Importantes (Resumo)',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Boleto (recursos próprios):</strong> pagar em até 3 dias.</li>
                    <li><strong>Boleto (validade portal):</strong> 2 dias úteis.</li>
                    <li><strong>Envio de RGI e IPTU em nome do comprador:</strong> até 60 dias após a compra.</li>
                    <li><strong>Liminar de desocupação judicial: possibilidade de 60 dias.</strong></li>
                </ul>
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

    @php
    $howToSteps = collect($manual)->map(fn($item) => [
        '@type' => 'HowToStep',
        'name'  => $item['titulo'],
        'url'   => route('manual.imoveis') . '#manual-' . $item['id'],
    ])->all();
    @endphp
    @push('head')
    <script type="application/ld+json">
{!! json_encode(array_filter([
    '@context'    => 'https://schema.org',
    '@type'       => 'HowTo',
    'name'        => 'Manual de Compra dos Imóveis da CAIXA',
    'description' => 'Passo a passo completo para comprar um imóvel da CAIXA: portal, modalidades de venda, proposta, pagamento e desocupação.',
    'step'        => $howToSteps,
]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endpush

    {{-- ── 8. FORMULÁRIO DE CADASTRO ──────────────────────────── --}}
    @include('partials.lead-form', [
        'pageName' => 'Manual de Compra dos Imóveis da CAIXA',
        'heading' => 'Cadastro de Interesse de Compra',
        'subheading' => 'Preencha o formulário e um Corretor Credenciado entrará em contato pelo WhatsApp.',
        'declarations' => [
            'Este manual tem caráter informativo e não substitui a leitura do edital ou da ficha do imóvel',
            'Para compra financiada é preciso aprovação antecipada de crédito',
            'Os imóveis da CAIXA só podem ser financiados pela CAIXA e não aceitam carta de consórcio',
        ],
    ])


    {{-- ── CTA TREINAMENTO ──────────────────────────────────── --}}
    <section class="bg-gradient-to-r from-caixa-orange to-orange-600 rounded-2xl p-8 sm:p-10 text-center text-white">
        <p class="text-sm font-bold uppercase tracking-widest opacity-90 mb-2">Para investidores</p>
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3">Quer lucrar com Flipping Imobiliário?</h2>
        <p class="text-white/90 mb-6">Aprenda a comprar imóveis com +50% de desconto e revender rápido com lucro extraordinário.</p>
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 bg-white text-caixa-orange font-bold px-8 py-3 rounded-xl hover:bg-orange-50 transition-colors">
            Ver o Treinamento — R$47 →
        </a>
    </section>

</div>

@endsection
