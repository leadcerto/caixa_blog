<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin — @yield('admin_title', 'Painel') | Imóveis da Caixa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-alt text-text-primary font-sans antialiased">

    {{-- Header Admin --}}
    <header class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="font-bold text-sm text-white/90 hover:text-white">
                        Imóveis da Caixa
                    </a>
                    <nav class="hidden md:flex items-center gap-1">
                        <a href="{{ route('dashboard') }}" class="text-white/70 hover:text-white hover:bg-white/10 px-3 py-1.5 rounded-lg text-sm transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="text-white/70 hover:text-white hover:bg-white/10 px-3 py-1.5 rounded-lg text-sm transition-colors">
                            Posts
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="text-white/70 hover:text-white hover:bg-white/10 px-3 py-1.5 rounded-lg text-sm transition-colors">
                            Categorias
                        </a>
                        <a href="{{ route('admin.agencies.index') }}" class="text-white/70 hover:text-white hover:bg-white/10 px-3 py-1.5 rounded-lg text-sm transition-colors">
                            Agências
                        </a>
                    </nav>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white/60 hover:text-white text-sm transition-colors">Sair</button>
                </form>
            </div>
        </div>
    </header>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
                ✓ {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Conteúdo --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('admin_content')
    </main>

    @stack('scripts')
</body>
</html>
