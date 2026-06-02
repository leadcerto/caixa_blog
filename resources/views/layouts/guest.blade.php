<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">

        <title>{{ config('app.name', 'Imóveis da Caixa') }} — Acesso Administrativo</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50">

        <div class="min-h-screen flex flex-col items-center justify-center px-4">

            {{-- Logo / Marca --}}
            <a href="/" class="flex flex-col items-center mb-8 group">
                <span class="text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors leading-tight">
                    Imóveis da Caixa
                </span>
                <span class="text-xs font-bold text-orange-500 uppercase tracking-widest mt-0.5">
                    Administrativo
                </span>
            </a>

            {{-- Card do formulário --}}
            <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-slate-200 px-8 py-8">
                {{ $slot }}
            </div>

            {{-- Rodapé discreto --}}
            <p class="mt-6 text-xs text-slate-400">
                Acesso restrito à equipe interna. &copy; {{ date('Y') }} Imóveis da Caixa.
            </p>
        </div>

    </body>
</html>
