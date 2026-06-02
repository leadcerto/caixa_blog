@extends('layouts.blog')

@section('title', 'Política de Privacidade — Imóveis da Caixa')
@section('meta_description', 'Conheça a Política de Privacidade do site Imóveis da Caixa. Saiba como coletamos, usamos e protegemos suas informações pessoais.')
@section('canonical_url', route('privacidade'))

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-14 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-6">
            <ol class="flex items-center gap-2 text-sm text-white/60">
                <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Início</a></li>
                <li class="text-white/40">/</li>
                <li class="text-white/90 font-medium">Política de Privacidade</li>
            </ol>
        </nav>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">Política de Privacidade</h1>
        <p class="text-white/70 text-sm">Vigente a partir de 3 de março de 2023</p>
    </div>
</section>

{{-- CONTEÚDO --}}
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="bg-surface border border-border rounded-2xl p-8 sm:p-10 space-y-10 prose prose-slate max-w-none">

        {{-- Introdução --}}
        <section>
            <p class="text-text-secondary leading-relaxed">
                A sua privacidade é importante para nós. É política do <strong>Imóveis da Caixa</strong> respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site Imóveis da Caixa e outros sites que possuímos e operamos.
            </p>
        </section>

        {{-- Coleta de informações --}}
        <section>
            <h2 class="text-xl font-bold text-text-primary mb-4">Coleta e uso de informações</h2>
            <div class="space-y-4 text-text-secondary leading-relaxed">
                <p>Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que estamos coletando e como será usado.</p>
                <p>Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis para evitar perdas e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.</p>
                <p>Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando exigido por lei.</p>
            </div>
        </section>

        {{-- Links externos --}}
        <section>
            <h2 class="text-xl font-bold text-text-primary mb-4">Links para sites externos</h2>
            <p class="text-text-secondary leading-relaxed">
                O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas respectivas políticas de privacidade.
            </p>
        </section>

        {{-- Publicidade e cookies --}}
        <section>
            <h2 class="text-xl font-bold text-text-primary mb-4">Publicidade e cookies</h2>
            <div class="space-y-3">
                @foreach([
                    'O serviço Google AdSense que usamos para veicular publicidade usa um cookie DoubleClick para veicular anúncios mais relevantes em toda a Web e limitar o número de vezes que um determinado anúncio é exibido para você.',
                    'Para mais informações sobre o Google AdSense, consulte as FAQs oficiais sobre privacidade do Google AdSense.',
                    'Utilizamos anúncios para compensar os custos de funcionamento deste site e fornecer financiamento para futuros desenvolvimentos. Os cookies de publicidade comportamental usados por este site foram projetados para garantir que você forneça os anúncios mais relevantes sempre que possível, rastreando anonimamente seus interesses e apresentando coisas semelhantes que possam ser do seu interesse.',
                    'Vários parceiros anunciam em nosso nome e os cookies de rastreamento de afiliados simplesmente nos permitem ver se nossos clientes acessaram o site através de um dos sites de nossos parceiros, para que possamos creditá-los adequadamente e, quando aplicável, permitir que nossos parceiros afiliados ofereçam qualquer promoção para fazer uma compra.',
                ] as $item)
                <div class="flex gap-3 text-text-secondary text-sm leading-relaxed">
                    <span class="text-caixa-blue mt-1 flex-shrink-0">•</span>
                    <p>{{ $item }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Compromisso do usuário --}}
        <section>
            <h2 class="text-xl font-bold text-text-primary mb-4">Compromisso do Usuário</h2>
            <p class="text-text-secondary leading-relaxed mb-4">
                O usuário se compromete a fazer uso adequado dos conteúdos e da informação que o Imóveis da Caixa oferece no site e com caráter enunciativo, mas não limitativo:
            </p>
            <div class="space-y-3">
                @foreach([
                    ['A', 'Não se envolver em atividades que sejam ilegais ou contrárias à boa-fé e à ordem pública.'],
                    ['B', 'Não difundir propaganda ou conteúdo de natureza racista, xenofóbica, de jogos de azar, qualquer tipo de pornografia ilegal, de apologia ao terrorismo ou contra os direitos humanos.'],
                    ['C', 'Não causar danos aos sistemas físicos (hardwares) e lógicos (softwares) do Imóveis da Caixa, de seus fornecedores ou terceiros, para introduzir ou disseminar vírus informáticos ou quaisquer outros sistemas de hardware ou software que sejam capazes de causar danos anteriormente mencionados.'],
                ] as [$letra, $texto])
                <div class="flex gap-3 items-start">
                    <span class="w-7 h-7 rounded-lg bg-caixa-blue/10 text-caixa-blue font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">{{ $letra }}</span>
                    <p class="text-text-secondary text-sm leading-relaxed">{{ $texto }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Mais informações --}}
        <section>
            <h2 class="text-xl font-bold text-text-primary mb-4">Mais informações</h2>
            <div class="space-y-4 text-text-secondary leading-relaxed">
                <p>Esperemos que esteja esclarecido e, como mencionado anteriormente, se houver algo que você não tem certeza se precisa ou não, geralmente é mais seguro deixar os cookies ativados, caso interaja com um dos recursos que você usa em nosso site.</p>
                <p>Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não possamos fornecer alguns dos serviços desejados. O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de privacidade e informações pessoais.</p>
            </div>
        </section>

        {{-- Contato --}}
        <section class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-xl p-6">
            <h2 class="text-lg font-bold text-text-primary mb-2">Dúvidas sobre privacidade?</h2>
            <p class="text-text-secondary text-sm leading-relaxed mb-4">
                Se você tiver alguma dúvida sobre como lidamos com dados do usuário e informações pessoais, entre em contato conosco.
            </p>
            <div class="flex flex-wrap gap-4 text-sm">
                <a href="mailto:{{ env('APP_COMPANY_EMAIL', 'sac@imoveisdacaixa.com.br') }}"
                   class="inline-flex items-center gap-2 text-caixa-blue hover:underline font-semibold">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ env('APP_COMPANY_EMAIL', 'sac@imoveisdacaixa.com.br') }}
                </a>
                <a href="https://wa.me/{{ preg_replace('/\D/', '', env('APP_COMPANY_WHATSAPP', '21997882950')) }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 text-caixa-blue hover:underline font-semibold">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </section>

        {{-- Rodapé da política --}}
        <p class="text-text-muted text-xs border-t border-border pt-6">
            Esta política é efetiva a partir de <strong>3 de março de 2023</strong>.
            {{ env('APP_COMPANY_NAME', 'Imóveis da Caixa LTDA') }} — CNPJ {{ env('APP_COMPANY_CNPJ', '50.563.863/0001-45') }}
        </p>

    </div>
</div>

@endsection
