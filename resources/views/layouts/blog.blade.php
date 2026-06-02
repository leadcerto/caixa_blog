<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Blog sobre House Flipping de Imóveis da Caixa Econômica Federal. Aprenda a arrematar, investir e lucrar com imóveis da Caixa.')">
    <meta name="robots" content="index, follow">

    {{-- Canonical --}}
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    {{-- Open Graph --}}
    <meta property="og:site_name" content="Imóveis da Caixa">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="@yield('title', 'Blog | Imóveis da Caixa')">
    <meta property="og:description" content="@yield('meta_description', 'Blog sobre House Flipping de Imóveis da Caixa.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', '')">
    @yield('og_article_meta')

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Blog | Imóveis da Caixa')">
    <meta name="twitter:description" content="@yield('meta_description', 'Blog sobre House Flipping de Imóveis da Caixa.')">
    <meta name="twitter:image" content="@yield('og_image', '')">

    <title>@yield('title', 'Blog | Imóveis da Caixa')</title>

    @stack('head')

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-text-primary font-sans antialiased">

    {{-- ═══════════════════════════════════════════════════════════════════
         HEADER CORPORATIVO — Azul Caixa
    ═══════════════════════════════════════════════════════════════════ --}}
    <header class="bg-caixa-blue sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo / Nome --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z" />
                        </svg>
                    </div>
                    <span class="text-white font-bold text-lg tracking-tight hidden sm:block">Imóveis da Caixa</span>
                </a>

                {{-- Navegação principal --}}
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('blog.index') }}"
                       class="text-white/90 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Blog
                    </a>

                    {{-- Menu de Categorias --}}
                    @if(isset($navCategories) && $navCategories->count())
                        <div class="relative group">
                            <button class="text-white/90 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-1">
                                Categorias
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border border-border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 py-2 z-50">
                                @foreach($navCategories as $cat)
                                    <a href="{{ route('blog.category', $cat->slug) }}"
                                       class="block px-4 py-2.5 text-sm text-text-primary hover:bg-caixa-blue-light hover:text-caixa-blue transition-colors">
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </nav>

                {{-- CTA Header --}}
                <a href="https://venda.imoveisdacaixa.com.br"
                   target="_blank"
                   rel="noopener"
                   class="bg-caixa-orange hover:bg-caixa-orange-dark text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 hidden sm:inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Buscar Imóveis
                </a>

                {{-- Mobile menu toggle --}}
                <button id="mobile-menu-btn" class="md:hidden text-white p-2 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="md:hidden hidden border-t border-white/10">
            <div class="px-4 py-4 space-y-2">
                <a href="{{ route('blog.index') }}" class="block text-white/90 hover:text-white hover:bg-white/10 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">Blog</a>
                @if(isset($navCategories) && $navCategories->count())
                    <p class="text-white/50 text-xs font-semibold uppercase tracking-wider px-4 pt-2">Categorias</p>
                    @foreach($navCategories as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}" class="block text-white/80 hover:text-white hover:bg-white/10 px-6 py-2 rounded-lg text-sm transition-colors">{{ $cat->name }}</a>
                    @endforeach
                @endif
                <a href="https://venda.imoveisdacaixa.com.br" target="_blank" rel="noopener" class="block bg-caixa-orange hover:bg-caixa-orange-dark text-white text-center font-semibold text-sm px-4 py-3 rounded-lg transition-colors mt-3">
                    🔍 Buscar Imóveis da Caixa
                </a>
            </div>
        </div>
    </header>

    {{-- ═══════════════════════════════════════════════════════════════════
         CONTEÚDO PRINCIPAL
    ═══════════════════════════════════════════════════════════════════ --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- ═══════════════════════════════════════════════════════════════════
         RODAPÉ — Sobre a Instituição
    ═══════════════════════════════════════════════════════════════════ --}}
    <footer class="bg-gray-900 text-white mt-20">
        {{-- CTA Final (presente em todas as páginas) --}}
        <div class="bg-gradient-to-r from-caixa-blue to-caixa-blue-dark">
            <div class="max-w-4xl mx-auto px-4 py-12 text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3">Pronto para encontrar o imóvel ideal?</h2>
                <p class="text-white/80 mb-6 text-lg">Acesse nossa plataforma de busca e encontre oportunidades exclusivas da Caixa.</p>
                <a href="https://venda.imoveisdacaixa.com.br"
                   target="_blank"
                   rel="noopener"
                   class="inline-flex items-center gap-2 bg-caixa-orange hover:bg-caixa-orange-dark text-white font-bold text-lg px-8 py-4 rounded-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    🏠 Buscar Imóveis da Caixa Agora
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Rodapé institucional --}}
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Links --}}
            <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-6">
                <a href="{{ route('home') }}"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Inicial
                </a>
                <span class="text-gray-700">–</span>
                <a href="{{ route('privacidade') }}"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Privacidade
                </a>
                <span class="text-gray-700">–</span>
                <a href="https://venda.imoveisdacaixa.com.br"
                   target="_blank" rel="noopener"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Busca de Imóveis
                </a>
            </nav>

            {{-- Dados da empresa --}}
            <div class="text-center space-y-1">
                <p class="text-gray-300 text-sm font-semibold">Imobiliária Imóveis da Caixa LTDA</p>
                <p class="text-gray-500 text-xs">CNPJ 50.563.863/0001-45 &nbsp;–&nbsp; CRECI-PJ 10.234/RJ</p>
                <p class="text-gray-600 text-xs">Copyright &copy; 2020 Todos os direitos reservados</p>
            </div>
        </div>
    </footer>

    {{-- Botão flutuante WhatsApp --}}
    @php $wpp = preg_replace('/\D/', '', env('APP_COMPANY_WHATSAPP', '21997882950')); @endphp
    <a href="https://wa.me/{{ $wpp }}?text=Ol%C3%A1%2C%20vim%20pelo%20site%20Im%C3%B3veis%20da%20Caixa%20e%20gostaria%20de%20atendimento."
       target="_blank" rel="noopener"
       aria-label="Atendimento pelo WhatsApp"
       class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 bg-[#25D366] hover:bg-[#1ebe5c] text-white font-bold px-6 py-3 rounded-full shadow-2xl transition-all duration-300 hover:scale-105 hover:shadow-green-500/40"
       style="box-shadow: 0 4px 24px rgba(37,211,102,0.45);">
        <svg class="w-7 h-7 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        <div class="leading-tight">
            <div class="text-sm font-extrabold tracking-wide">Atendimento Rápido</div>
            <div class="text-xs font-semibold opacity-90">Clique Aqui</div>
        </div>
    </a>

    {{-- Mobile menu toggle script --}}
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function () {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });
    </script>
</body>
</html>
