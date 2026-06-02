@extends('layouts.admin')

@section('admin_title', 'Dashboard')

@section('admin_content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-text-primary">Dashboard</h1>
        <p class="text-sm text-text-secondary mt-1">Visão geral em tempo real</p>
    </div>

    {{-- Cards de resumo --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">

        {{-- Posts publicados --}}
        <div class="bg-surface rounded-xl border border-border p-5">
            <p class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-3">Posts Publicados</p>
            <p class="text-3xl font-bold text-green-600">
                {{ \App\Models\Post::where('is_published', true)->count() }}
            </p>
            <a href="{{ route('admin.posts.index') }}" class="text-xs text-caixa-blue hover:underline mt-2 inline-block">Ver posts →</a>
        </div>

        {{-- Rascunhos --}}
        <div class="bg-surface rounded-xl border border-border p-5">
            <p class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-3">Rascunhos</p>
            <p class="text-3xl font-bold text-orange-500">
                {{ \App\Models\Post::where('is_published', false)->count() }}
            </p>
            <a href="{{ route('admin.posts.create') }}" class="text-xs text-caixa-blue hover:underline mt-2 inline-block">Criar artigo →</a>
        </div>

        {{-- Categorias --}}
        <div class="bg-surface rounded-xl border border-border p-5">
            <p class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-3">Categorias</p>
            <p class="text-3xl font-bold text-slate-700">
                {{ \App\Models\Category::count() }}
            </p>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-caixa-blue hover:underline mt-2 inline-block">Gerenciar →</a>
        </div>

        {{-- Agências --}}
        <div class="bg-surface rounded-xl border border-border p-5">
            <p class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-3">Agências (GMB)</p>
            <p class="text-3xl font-bold text-slate-700">
                {{ \App\Models\Agency::count() }}
            </p>
            <a href="{{ route('admin.agencies.index') }}" class="text-xs text-caixa-blue hover:underline mt-2 inline-block">Gerenciar →</a>
        </div>

    </div>

    {{-- Atalhos rápidos --}}
    <div class="bg-surface rounded-xl border border-border p-6">
        <h2 class="text-sm font-bold text-text-primary mb-4">Ações rápidas</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.posts.create') }}"
               class="bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
                + Novo Artigo
            </a>
            <a href="{{ route('admin.categories.create') }}"
               class="bg-white border border-border hover:border-caixa-blue text-text-primary hover:text-caixa-blue font-semibold text-sm px-5 py-2.5 rounded-lg transition-all duration-200">
                + Nova Categoria
            </a>
            <a href="{{ route('admin.agencies.create') }}"
               class="bg-white border border-border hover:border-caixa-blue text-text-primary hover:text-caixa-blue font-semibold text-sm px-5 py-2.5 rounded-lg transition-all duration-200">
                + Nova Agência
            </a>
        </div>
    </div>

@endsection
