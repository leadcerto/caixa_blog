@extends('layouts.admin')

@section('admin_title', 'Editar — ' . $agency->name)

@section('admin_content')

    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('admin.agencies.index') }}" class="text-sm text-text-muted hover:text-caixa-blue transition-colors mb-2 inline-block">← Voltar para Agências</a>
            <h1 class="text-2xl font-bold text-text-primary">Editar Agência</h1>
            <p class="text-sm text-text-secondary mt-1">{{ $agency->neighborhood }}, {{ $agency->city }}/{{ $agency->state }} • Ag. {{ $agency->agency_number }}</p>
        </div>
        <a href="{{ route('admin.agencies.reviews', $agency) }}"
           class="text-sm text-caixa-blue hover:text-caixa-blue-dark font-semibold transition-colors">
            Ver Avaliações →
        </a>
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

    <form method="POST" action="{{ route('admin.agencies.update', $agency) }}" class="max-w-2xl">
        @csrf
        @method('PUT')

        <div class="bg-surface rounded-xl border border-border p-6 space-y-6">

            {{-- Nome e Número --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-semibold text-text-primary mb-1.5">Nome da Agência <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $agency->name) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('name') border-red-400 @enderror">
                </div>
                <div>
                    <label for="agency_number" class="block text-sm font-semibold text-text-primary mb-1.5">Número da Agência <span class="text-red-500">*</span></label>
                    <input type="text" id="agency_number" name="agency_number" value="{{ old('agency_number', $agency->agency_number) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm font-mono text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('agency_number') border-red-400 @enderror">
                </div>
            </div>

            {{-- Endereço --}}
            <div>
                <label for="address" class="block text-sm font-semibold text-text-primary mb-1.5">Endereço Completo <span class="text-red-500">*</span></label>
                <input type="text" id="address" name="address" value="{{ old('address', $agency->address) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('address') border-red-400 @enderror">
            </div>

            {{-- Bairro, Cidade, Estado, CEP --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="col-span-2 sm:col-span-2">
                    <label for="neighborhood" class="block text-sm font-semibold text-text-primary mb-1.5">Bairro <span class="text-red-500">*</span></label>
                    <input type="text" id="neighborhood" name="neighborhood" value="{{ old('neighborhood', $agency->neighborhood) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('neighborhood') border-red-400 @enderror">
                </div>
                <div>
                    <label for="city" class="block text-sm font-semibold text-text-primary mb-1.5">Cidade <span class="text-red-500">*</span></label>
                    <input type="text" id="city" name="city" value="{{ old('city', $agency->city) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('city') border-red-400 @enderror">
                </div>
                <div>
                    <label for="state" class="block text-sm font-semibold text-text-primary mb-1.5">UF <span class="text-red-500">*</span></label>
                    <input type="text" id="state" name="state" value="{{ old('state', $agency->state) }}" required maxlength="2"
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm font-mono uppercase text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent @error('state') border-red-400 @enderror">
                </div>
            </div>

            {{-- CEP e Telefone --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="zip_code" class="block text-sm font-semibold text-text-primary mb-1.5">CEP</label>
                    <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code', $agency->zip_code) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm font-mono text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-semibold text-text-primary mb-1.5">Telefone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $agency->phone) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
                </div>
            </div>

            {{-- Horário de Funcionamento --}}
            <div>
                <label for="opening_hours" class="block text-sm font-semibold text-text-primary mb-1.5">Horário de Funcionamento</label>
                <input type="text" id="opening_hours" name="opening_hours" value="{{ old('opening_hours', $agency->opening_hours) }}"
                       placeholder="Ex: Seg–Sex, 10h às 16h"
                       class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
            </div>

            {{-- Google Location ID --}}
            <div>
                <label for="google_location_id" class="block text-sm font-semibold text-text-primary mb-1.5">Google Location ID</label>
                <input type="text" id="google_location_id" name="google_location_id" value="{{ old('google_location_id', $agency->google_location_id) }}"
                       placeholder="Ex: accounts/123456789/locations/987654321"
                       class="w-full px-4 py-2.5 rounded-xl border border-border bg-surface text-sm font-mono text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
                <p class="text-xs text-text-muted mt-1.5">Necessário para sincronizar avaliações do Google.</p>
            </div>

            {{-- Slug (somente leitura) --}}
            <div>
                <label class="block text-sm font-semibold text-text-primary mb-1.5">Slug (gerado automaticamente)</label>
                <div class="px-4 py-2.5 rounded-xl border border-border bg-surface-muted text-sm font-mono text-text-muted select-all">
                    /imoveis_caixa/{{ $agency->slug }}
                </div>
            </div>
        </div>

        {{-- Ações --}}
        <div class="flex items-center gap-4 mt-6">
            <button type="submit" class="bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-6 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
                Salvar Alterações
            </button>
            <a href="{{ route('admin.agencies.index') }}" class="text-sm text-text-muted hover:text-text-primary transition-colors">
                Cancelar
            </a>
        </div>
    </form>

@endsection
