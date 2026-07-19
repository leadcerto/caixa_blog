@extends('layouts.blog')

@section('title', 'Venda de Imóveis da CAIXA — Guia Completo | Imóveis da Caixa')
@section('meta_description', 'Tudo sobre a Venda de Imóveis da CAIXA: benefícios exclusivos, passo a passo de compra, modalidades, perguntas frequentes e assessoria gratuita.')
@section('canonical_url', route('venda.imoveis'))

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-xs font-bold uppercase tracking-widest text-amber-300 mb-4">Guia Oficial</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight mb-6">
            Venda de Imóveis da <span class="text-caixa-orange">CAIXA</span>
        </h1>
        <p class="text-lg sm:text-xl text-white/90 max-w-3xl mx-auto mb-8">
            Imóveis com até <strong class="text-white">70% de desconto</strong>, entrada de apenas <strong class="text-white">5%</strong>, sem comissão de corretor e com assessoria gratuita. Saiba tudo aqui.
        </p>
        <a href="#cadastro"
           class="inline-flex items-center gap-2 bg-caixa-orange hover:bg-orange-600 text-white font-bold text-lg px-8 py-4 rounded-xl transition-colors">
            Quero ser atendido gratuitamente →
        </a>
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


    {{-- ── LINK CRUZADO: MANUAL DE COMPRA ───────────────────────── --}}
    <section class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-2xl p-6 sm:p-8 text-center">
        <h2 class="text-xl font-bold text-text-primary mb-2">Já decidiu comprar?</h2>
        <p class="text-text-secondary mb-4">Veja o Manual de Compra passo a passo: portal, modalidades, proposta, pagamento e desocupação.</p>
        <a href="{{ route('manual.imoveis') }}" class="inline-flex items-center gap-2 bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold px-6 py-3 rounded-xl transition-colors">
            Ver o Manual de Compra →
        </a>
    </section>

    {{-- ── 8. FORMULÁRIO DE CADASTRO ──────────────────────────── --}}
    @include('partials.lead-form', [
        'pageName' => 'Venda de Imóveis da CAIXA',
        'heading' => 'Cadastro de Interesse de Compra',
        'subheading' => 'Preencha o formulário e um Corretor Credenciado entrará em contato pelo WhatsApp.',
        'declarations' => [
            'Para compra financiada é preciso aprovação antecipada de crédito',
            'Os imóveis da CAIXA são retomados de acordo com a Lei 9.514 (alienação fiduciária)',
            'Os imóveis só podem ser financiados pela CAIXA e não aceitam carta de consórcio',
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
