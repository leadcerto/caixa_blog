@extends('layouts.admin')

@section('admin_title', 'Categorias')

@section('admin_content')

    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Categorias</h1>
            <p class="text-sm text-text-secondary mt-1">Organize as pautas do blog por tema</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
            + Nova Categoria
        </a>
    </div>

    {{-- Flash de erro (ex: tentativa de excluir categoria com posts) --}}
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6">
            ⚠ {{ session('error') }}
        </div>
    @endif

    {{-- Tabela --}}
    @if($categories->count())
        <div class="bg-surface rounded-xl border border-border overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border bg-surface-muted">
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Nome</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Descrição SEO</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Slug</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Posts</th>
                        <th class="text-right px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach($categories as $category)
                        <tr class="hover:bg-surface-muted/40 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-text-primary">{{ $category->name }}</p>
                            </td>
                            <td class="px-6 py-4 text-text-secondary max-w-xs">
                                @if($category->description)
                                    <p class="text-sm truncate">{{ $category->description }}</p>
                                @else
                                    <span class="text-text-muted text-xs italic">Sem descrição</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <code class="text-xs bg-surface-muted text-text-secondary px-2 py-1 rounded">{{ $category->slug }}</code>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.posts.index') }}"
                                   class="inline-flex items-center gap-1 text-caixa-blue hover:text-caixa-blue-dark font-semibold text-sm transition-colors">
                                    {{ $category->posts_count }}
                                    <span class="text-xs text-text-muted font-normal">posts</span>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="text-caixa-blue hover:text-caixa-blue-dark text-xs font-semibold transition-colors">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                          onsubmit="return confirm('Remover a categoria \'{{ addslashes($category->name) }}\'? Esta ação não pode ser desfeita.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-400 hover:text-red-600 text-xs transition-colors {{ $category->posts_count > 0 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                                {{ $category->posts_count > 0 ? 'title=\'Remova ou reatribua os posts antes de excluir\'' : '' }}>
                                            Remover
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-16 bg-surface rounded-xl border border-border">
            <svg class="w-12 h-12 text-text-muted mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
            </svg>
            <p class="text-text-secondary font-medium">Nenhuma categoria criada ainda.</p>
            <a href="{{ route('admin.categories.create') }}" class="inline-block mt-4 bg-caixa-blue text-white font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-caixa-blue-dark transition-colors">
                Criar primeira categoria
            </a>
        </div>
    @endif

@endsection
