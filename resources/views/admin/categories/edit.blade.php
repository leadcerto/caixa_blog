@extends('layouts.admin')

@section('admin_title', 'Editar — ' . $category->name)

@section('admin_content')

    <div class="mb-8">
        <a href="{{ route('admin.categories.index') }}" class="text-sm text-text-muted hover:text-caixa-blue transition-colors mb-2 inline-block">← Voltar para Categorias</a>
        <h1 class="text-2xl font-bold text-text-primary">Editar Categoria</h1>
        <p class="text-sm text-text-secondary mt-1">{{ $category->posts()->count() }} post(s) vinculado(s)</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6">
            <p class="font-semibold mb-1">Corrija os campos abaixo:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="max-w-xl">
        @csrf
        @method('PUT')

        <div class="bg-surface rounded-xl border border-border p-6 space-y-5">

            <div>
                <label for="name" class="block text-sm font-semibold text-text-primary mb-1.5">
                    Nome <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-border bg-white text-sm text-text-primary focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('name') border-red-400 @enderror">
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-text-primary mb-1.5">
                    Descrição SEO
                </label>
                <textarea id="description" name="description" rows="4"
                          placeholder="Texto exibido no topo da página de listagem desta categoria."
                          class="w-full px-4 py-2.5 rounded-xl border border-border bg-white text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent resize-none @error('description') border-red-400 @enderror">{{ old('description', $category->description) }}</textarea>
                <p class="text-xs text-text-muted mt-1.5">Máximo 500 caracteres.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-1.5">Slug (somente leitura)</label>
                <div class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-border bg-surface-muted">
                    <span class="text-xs text-text-muted">/blog/categoria/</span>
                    <code class="text-sm text-text-secondary font-mono">{{ $category->slug }}</code>
                </div>
                <p class="text-xs text-text-muted mt-1.5">O slug não muda ao editar o nome para preservar links indexados.</p>
            </div>

        </div>

        <div class="flex items-center gap-4 mt-6">
            <button type="submit"
                    class="bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-6 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
                Salvar Alterações
            </button>
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-text-muted hover:text-text-primary transition-colors">
                Cancelar
            </a>
        </div>
    </form>

@endsection
