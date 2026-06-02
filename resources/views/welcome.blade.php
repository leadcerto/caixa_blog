<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipping Imobiliário Simplificado — Compre com +50% de Desconto e Lucre Rápido</title>
    <meta name="description" content="Aprenda a comprar imóveis com mais de 50% de desconto em leilões da Caixa e revender rápido com lucro extraordinário. Treinamento completo por apenas R$47.">
    <link rel="canonical" href="{{ config('app.url') }}">
    <meta property="og:title" content="Flipping Imobiliário Simplificado">
    <meta property="og:description" content="Aprenda a comprar imóveis com mais de 50% de desconto e revender rápido com lucro extraordinário.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gradient-hero { background: linear-gradient(135deg, #0a1628 0%, #0d2040 50%, #0a1628 100%); }
        .card-dark { background: linear-gradient(135deg, #1a2744 0%, #1e3058 100%); }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(247,148,30,0.4); }
            50%       { box-shadow: 0 0 45px rgba(247,148,30,0.9); }
        }
        .btn-pulse { animation: pulse-glow 2s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-950 text-white font-sans antialiased">

    {{-- Barra de urgência --}}
    <div class="bg-[#F7941E] text-white text-center text-sm font-bold py-2 px-4">
        🏠 OFERTA DE LANÇAMENTO — apenas <span class="underline">R$47</span> por tempo limitado
    </div>

    {{-- ── HERO ──────────────────────────────────────────── --}}
    <section class="gradient-hero py-16 sm:py-24 px-4">
        <div class="max-w-4xl mx-auto text-center">

            <div class="inline-flex items-center gap-2 bg-[#F7941E]/20 border border-[#F7941E]/40 text-[#F7941E] text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-8">
                🎓 Treinamento em Vídeo Aulas
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black leading-tight mb-6">
                Aprenda a comprar imóveis com
                <span class="text-[#F7941E]">mais de 50% de desconto</span>
                e revender rápido com
                <span class="text-[#F7941E]">lucro extraordinário</span>
            </h1>

            <p class="text-lg sm:text-xl text-gray-300 leading-relaxed mb-10 max-w-3xl mx-auto">
                Descubra como qualquer pessoa — mesmo sem experiência — pode lucrar comprando imóveis leiloados pela Caixa Econômica Federal com desconto acima de 50% e revendendo com alta margem de lucro.
            </p>

            <a href="#comprar" class="btn-pulse inline-flex items-center gap-3 bg-[#F7941E] hover:bg-[#e07c0a] text-white font-black text-xl px-10 py-5 rounded-2xl transition-all duration-300 hover:scale-105 mb-4">
                QUERO APRENDER AGORA →
            </a>
            <p class="text-gray-400 text-sm">Apenas R$47 • Acesso imediato • Vídeo aulas completas</p>

        </div>
    </section>

    {{-- ── DOR ──────────────────────────────────────────── --}}
    <section class="bg-gray-900 py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold text-center mb-12">
                Por que <span class="text-[#F7941E]">poucas pessoas</span> lucram no mercado imobiliário enquanto a maioria fica de fora?
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach([
                    ['😰', 'Falta de clareza', 'Não sabe por onde começar, quais imóveis comprar nem como funciona o leilão.'],
                    ['😨', 'Medo e bloqueios', 'O mercado parece complicado, arriscado e acessível só para quem tem muito dinheiro.'],
                    ['😤', 'Informação fragmentada', 'Tudo que encontra na internet é vago ou serve apenas para quem já é especialista.'],
                ] as [$icon, $title, $desc])
                <div class="card-dark rounded-2xl p-6 border border-gray-700">
                    <div class="text-3xl mb-4">{{ $icon }}</div>
                    <h3 class="font-bold text-lg mb-2">{{ $title }}</h3>
                    <p class="text-gray-400 text-sm">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── SOLUÇÃO ────────────────────────────────────────── --}}
    <section class="bg-gray-950 py-16 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <p class="text-[#F7941E] text-sm font-bold uppercase tracking-widest mb-3">A solução</p>
            <h2 class="text-2xl sm:text-4xl font-black mb-4">Flipping Imobiliário Simplificado</h2>
            <p class="text-gray-300 text-lg mb-12 max-w-2xl mx-auto">
                O treinamento que desvenda o mercado de leilões da Caixa Econômica Federal e te entrega um passo a passo para lucrar mesmo sendo iniciante.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-left">
                @foreach([
                    ['🎬', 'Vídeo aulas completas', 'Todo o conteúdo em vídeo, no seu ritmo, acessível de qualquer dispositivo a qualquer hora.'],
                    ['🏦', 'Como funciona o mercado de leilão', 'Entenda o funcionamento dos leilões da Caixa Econômica Federal do zero, sem enrolação.'],
                    ['🧠', 'Destravando os bloqueios do investidor', 'Vença o medo, a insegurança e as crenças limitantes que impedem você de agir.'],
                    ['📋', 'Passo a passo de compra', 'Do primeiro acesso ao site da Caixa até a escritura no seu nome — sem nenhuma etapa perdida.'],
                ] as [$icon, $title, $desc])
                <div class="flex gap-4 card-dark rounded-2xl p-6 border border-gray-700">
                    <div class="text-2xl flex-shrink-0">{{ $icon }}</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">{{ $title }}</h3>
                        <p class="text-gray-400 text-sm">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── PARA QUEM É ──────────────────────────────────── --}}
    <section class="bg-gray-900 py-16 px-4">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-black text-center mb-10">
                Este treinamento é para <span class="text-[#F7941E]">você</span> se…
            </h2>
            <div class="space-y-4">
                @foreach([
                    'Quer uma nova fonte de renda mas não sabe por onde começar no mercado imobiliário',
                    'Já ouviu falar de leilões mas nunca teve coragem ou clareza para participar',
                    'Quer comprar um imóvel abaixo do mercado e revender com alta margem de lucro',
                    'Busca uma profissão que pode exercer no seu próprio ritmo e horário',
                    'Quer investir em imóveis mas acha que precisa de muito capital para começar',
                ] as $item)
                <div class="flex items-start gap-3 card-dark rounded-xl p-4 border border-gray-700">
                    <svg class="w-5 h-5 text-[#F7941E] flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-gray-200">{{ $item }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── OFERTA / PREÇO ───────────────────────────────── --}}
    <section id="comprar" class="gradient-hero py-20 px-4">
        <div class="max-w-md mx-auto text-center">
            <p class="text-[#F7941E] text-sm font-bold uppercase tracking-widest mb-3">Oferta especial de lançamento</p>
            <h2 class="text-3xl sm:text-4xl font-black mb-8">Comece hoje mesmo</h2>

            <div class="card-dark rounded-3xl border border-[#F7941E]/40 p-8 mb-6">
                <div class="text-gray-500 line-through text-lg mb-1">De R$197,00</div>
                <div class="flex items-end justify-center gap-1 mb-2">
                    <span class="text-2xl font-bold text-gray-300 mb-2">R$</span>
                    <span class="text-7xl font-black text-[#F7941E] leading-none">47</span>
                    <span class="text-2xl font-bold text-gray-300 mb-2">,00</span>
                </div>
                <p class="text-gray-400 text-sm mb-6">Pagamento único • Acesso imediato</p>

                <div class="space-y-3 text-left mb-8">
                    @foreach([
                        'Vídeo aulas sobre o mercado de leilão da Caixa',
                        'Módulo de destravamento do investidor',
                        'Passo a passo completo de compra',
                        'Acesso vitalício ao conteúdo',
                        'Suporte por e-mail',
                    ] as $item)
                    <div class="flex items-center gap-2 text-gray-200 text-sm">
                        <svg class="w-4 h-4 text-[#F7941E] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ $item }}
                    </div>
                    @endforeach
                </div>

                {{-- Botão — substituir href pelo link Kiwify quando disponível --}}
                <a href="#" class="btn-pulse block w-full bg-[#F7941E] hover:bg-[#e07c0a] text-white font-black text-xl py-5 rounded-2xl transition-all duration-300 hover:scale-105 text-center">
                    QUERO COMPRAR POR R$47 →
                </a>
                <p class="text-gray-500 text-xs mt-3">🔒 Pagamento 100% seguro via Kiwify</p>
            </div>

            <p class="text-gray-400 text-sm">
                Dúvidas? Fale com a gente:
                <a href="https://wa.me/{{ env('APP_COMPANY_WHATSAPP', '21997882950') }}" target="_blank" class="text-[#F7941E] hover:underline font-semibold">WhatsApp</a>
            </p>
        </div>
    </section>

    {{-- ── FOOTER ───────────────────────────────────────── --}}
    <footer class="bg-gray-950 border-t border-gray-800 py-10 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <div class="font-black text-lg text-white mb-1">Imóveis da Caixa</div>
                    <p class="text-gray-500 text-sm">Educação e consultoria em Flipping Imobiliário</p>
                </div>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="/blog" class="hover:text-white transition-colors">Blog</a>
                    <a href="/agencias" class="hover:text-white transition-colors">Agências</a>
                    <a href="https://wa.me/{{ env('APP_COMPANY_WHATSAPP', '21997882950') }}" target="_blank" class="hover:text-white transition-colors">Contato</a>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-600">
                <span>© {{ date('Y') }} {{ env('APP_COMPANY_NAME', 'Imóveis da Caixa LTDA') }} — CNPJ {{ env('APP_COMPANY_CNPJ', '50.563.863/0001-45') }}</span>
                <span>CRECI {{ env('APP_COMPANY_CRECI', '10.234/RJ') }}</span>
            </div>
        </div>
    </footer>

</body>
</html>
