@extends('layouts.admin')

@section('admin_title', 'Editar — ' . (mb_strlen($post->title) > 50 ? mb_substr($post->title, 0, 50) . '…' : $post->title))

@section('admin_content')

    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('admin.posts.index') }}" class="text-sm text-text-muted hover:text-caixa-blue transition-colors mb-2 inline-block">← Voltar para Posts</a>
            <h1 class="text-2xl font-bold text-text-primary">Editar Artigo</h1>
            <p class="text-sm text-text-secondary mt-1 font-mono">/blog/{{ $post->slug }}</p>
        </div>
        @if($post->is_published)
            <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
               class="text-sm text-caixa-blue hover:text-caixa-blue-dark font-semibold transition-colors">
                Ver artigo publicado →
            </a>
        @endif
    </div>

    {{-- Erros de validação --}}
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

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Coluna principal --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Título --}}
                <div class="bg-surface rounded-xl border border-border p-6">
                    <label for="title" class="block text-sm font-semibold text-text-primary mb-1.5">
                        Título do Artigo (H1) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-white text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('title') border-red-400 @enderror">
                    <p class="text-xs text-text-muted mt-1.5">O slug não muda ao editar o título (preserva links já indexados).</p>
                </div>

                {{-- Gancho (Hook Excerpt) --}}
                <div class="bg-surface rounded-xl border border-border p-6">
                    <label for="hook_excerpt" class="block text-sm font-semibold text-text-primary mb-1.5">
                        Gancho Inicial (Hook)
                    </label>
                    <textarea id="hook_excerpt" name="hook_excerpt" rows="3"
                              placeholder="Uma frase de impacto que prende o leitor e resume o valor do artigo."
                              class="w-full px-4 py-2.5 rounded-xl border border-border bg-white text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent resize-none @error('hook_excerpt') border-red-400 @enderror">{{ old('hook_excerpt', $post->hook_excerpt) }}</textarea>
                    <p class="text-xs text-text-muted mt-1.5">Máximo 500 caracteres. Será usado como <code>&lt;meta name="description"&gt;</code> no Google.</p>
                </div>

                {{-- Conteúdo (TinyMCE) --}}
                <div class="bg-surface rounded-xl border border-border p-6">
                    <label for="content" class="block text-sm font-semibold text-text-primary mb-3">
                        Conteúdo do Artigo <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" class="@error('content') border-red-400 @enderror">{{ old('content', $post->content) }}</textarea>
                </div>

            </div>

            {{-- Coluna lateral --}}
            <div class="space-y-6">

                {{-- Publicação --}}
                <div class="bg-surface rounded-xl border border-border p-6">
                    <h3 class="text-sm font-bold text-text-primary mb-4">Publicação</h3>

                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" id="is_published" name="is_published" value="1"
                                   {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="w-10 h-6 bg-gray-200 rounded-full peer-checked:bg-caixa-blue transition-colors"></div>
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-4"></div>
                        </div>
                        <span class="text-sm text-text-secondary group-hover:text-text-primary transition-colors">Artigo publicado</span>
                    </label>

                    @if($post->published_at)
                        <p class="text-xs text-text-muted mt-2">
                            Publicado em {{ $post->published_at->translatedFormat('d/m/Y \à\s H:i') }}
                        </p>
                    @endif

                    <div class="mt-6 pt-4 border-t border-border">
                        <button type="submit"
                                class="w-full bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-6 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
                            Salvar Alterações
                        </button>
                        <a href="{{ route('admin.posts.index') }}"
                           class="block text-center mt-3 text-sm text-text-muted hover:text-text-primary transition-colors">
                            Cancelar
                        </a>
                    </div>
                </div>

                {{-- Categoria --}}
                <div class="bg-surface rounded-xl border border-border p-6">
                    <label for="category_id" class="block text-sm font-bold text-text-primary mb-3">Categoria</label>
                    <select id="category_id" name="category_id"
                            class="w-full px-4 py-2.5 rounded-xl border border-border bg-white text-sm text-text-primary focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
                        <option value="">— Sem categoria —</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Imagem de Capa --}}
                <div class="bg-surface rounded-xl border border-border p-6">
                    <label class="block text-sm font-bold text-text-primary mb-3">Imagem de Capa</label>

                    {{-- Preview da imagem atual --}}
                    @if($post->featured_image)
                        <div id="current-image" class="mb-3">
                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                 alt="Capa atual"
                                 class="w-full rounded-lg object-cover max-h-40">
                            <p class="text-xs text-text-muted mt-1.5">Imagem atual. Selecione outra para substituir.</p>
                        </div>
                    @endif

                    <label for="featured_image"
                           class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-border rounded-xl cursor-pointer hover:border-caixa-blue hover:bg-blue-50/30 transition-colors group">
                        <svg class="w-7 h-7 text-text-muted group-hover:text-caixa-blue transition-colors mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        <span class="text-xs text-text-muted group-hover:text-caixa-blue transition-colors">Selecionar nova imagem</span>
                        <span class="text-xs text-text-muted mt-0.5">JPG, PNG, WEBP — Máx. 4MB</span>
                        <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden"
                               onchange="previewImage(this)">
                    </label>

                    <div id="image-preview" class="hidden mt-3">
                        <img id="preview-img" src="" alt="Nova capa" class="w-full rounded-lg object-cover max-h-40">
                        <button type="button" onclick="clearImage()"
                                class="mt-2 text-xs text-red-400 hover:text-red-600 transition-colors">
                            Cancelar troca
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection

@push('scripts')
{{-- TinyMCE via CDN --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        language: 'pt_BR',
        height: 520,
        menubar: false,
        plugins: 'lists link image media table code fullscreen',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | table | code fullscreen',
        block_formats: 'Parágrafo=p; Título 2=h2; Título 3=h3; Título 4=h4; Pré-formatado=pre',
        content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; color: #1a1a2e; line-height: 1.7; }',
        branding: false,
        promotion: false,
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearImage() {
        document.getElementById('featured_image').value = '';
        document.getElementById('image-preview').classList.add('hidden');
        document.getElementById('preview-img').src = '';
    }
</script>
@endpush
