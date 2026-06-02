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

        {{-- Informações institucionais --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- Sobre --}}
                <div>
                    <h3 class="font-bold text-lg mb-4 text-white">Sobre o Projeto</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Somos especialistas em <strong class="text-white">House Flipping de Imóveis da Caixa Econômica Federal</strong>.
                        Nosso blog educa investidores sobre arrematação, venda direta e licitações de imóveis públicos.
                    </p>
                </div>

                {{-- Categorias --}}
                <div>
                    <h3 class="font-bold text-lg mb-4 text-white">Categorias</h3>
                    <ul class="space-y-2">
                        @if(isset($navCategories) && $navCategories->count())
                            @foreach($navCategories as $cat)
                                <li>
                                    <a href="{{ route('blog.category', $cat->slug) }}"
                                       class="text-gray-400 hover:text-caixa-orange text-sm transition-colors">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                {{-- Links úteis --}}
                <div>
                    <h3 class="font-bold text-lg mb-4 text-white">Links Úteis</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-caixa-orange text-sm transition-colors">Blog</a></li>
                        <li><a href="https://venda.imoveisdacaixa.com.br" target="_blank" rel="noopener" class="text-gray-400 hover:text-caixa-orange text-sm transition-colors">Buscar Imóveis</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-10 pt-8 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Imóveis da Caixa — Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    {{-- Mobile menu toggle script --}}
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function () {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });
    </script>
</body>
</html>
