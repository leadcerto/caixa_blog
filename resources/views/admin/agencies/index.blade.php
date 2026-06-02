@extends('layouts.admin')

@section('admin_title', 'Agências')

@section('admin_content')

    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Agências</h1>
            <p class="text-sm text-text-secondary mt-1">Gerencie os escritórios e locais para SEO Local</p>
        </div>
        <a href="{{ route('admin.agencies.create') }}"
           class="bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
            + Nova Agência
        </a>
    </div>

    {{-- Tabela --}}
    @if($agencies->count())
        <div class="bg-surface rounded-xl border border-border overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border bg-surface-muted">
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Agência</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Localização</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Ag. Nº</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Avaliação</th>
                        <th class="text-left px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Reviews</th>
                        <th class="text-right px-6 py-3 text-text-muted font-semibold text-xs uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach($agencies as $agency)
                        <tr class="hover:bg-surface-muted/40 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-text-primary">{{ $agency->name }}</p>
                                <p class="text-xs text-text-muted mt-0.5 truncate max-w-xs">{{ $agency->address }}</p>
                            </td>
                            <td class="px-6 py-4 text-text-secondary">
                                {{ $agency->neighborhood }}, {{ $agency->city }}/{{ $agency->state }}
                            </td>
                            <td class="px-6 py-4 text-text-secondary font-mono text-xs">
                                {{ $agency->agency_number }}
                            </td>
                            <td class="px-6 py-4">
                                @if($agency->average_rating)
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <span class="text-text-primary font-semibold">{{ number_format($agency->average_rating, 1, ',', '') }}</span>
                                    </div>
                                @else
                                    <span class="text-text-muted text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.agencies.reviews', $agency) }}"
                                   class="inline-flex items-center gap-1 text-caixa-blue hover:text-caixa-blue-dark text-sm font-medium transition-colors">
                                    {{ $agency->reviews_count }}
                                    <span class="text-xs text-text-muted">avaliações</span>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('agencies.show', $agency->slug) }}"
                                       target="_blank"
                                       class="text-text-muted hover:text-caixa-blue text-xs transition-colors">
                                        Ver página
                                    </a>
                                    <a href="{{ route('admin.agencies.edit', $agency) }}"
                                       class="text-caixa-blue hover:text-caixa-blue-dark text-xs font-semibold transition-colors">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.agencies.destroy', $agency) }}"
                                          onsubmit="return confirm('Remover esta agência?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs transition-colors">
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

        {{-- Paginação --}}
        @if($agencies->hasPages())
            <div class="mt-6">
                {{ $agencies->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-16 bg-surface rounded-xl border border-border">
            <svg class="w-12 h-12 text-text-muted mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <p class="text-text-secondary font-medium">Nenhuma agência cadastrada ainda.</p>
            <a href="{{ route('admin.agencies.create') }}" class="inline-block mt-4 bg-caixa-blue text-white font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-caixa-blue-dark transition-colors">
                Cadastrar primeira agência
            </a>
        </div>
    @endif

@endsection
