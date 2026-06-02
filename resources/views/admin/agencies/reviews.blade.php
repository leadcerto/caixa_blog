@extends('layouts.admin')

@section('admin_title', 'Reviews — ' . $agency->name)

@section('admin_content')

    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('admin.agencies.index') }}" class="text-sm text-text-muted hover:text-caixa-blue transition-colors mb-2 inline-block">← Voltar para Agências</a>
            <h1 class="text-2xl font-bold text-text-primary">Avaliações — {{ $agency->name }}</h1>
            <p class="text-sm text-text-secondary mt-1">{{ $agency->neighborhood }}, {{ $agency->city }}/{{ $agency->state }} • Ag. {{ $agency->agency_number }}</p>
        </div>
        @if($agency->average_rating)
            <div class="text-right">
                <div class="flex items-center gap-1 justify-end">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= round($agency->average_rating) ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-text-secondary mt-1">Média: <strong>{{ number_format($agency->average_rating, 1, ',', '') }}</strong> ({{ $agency->reviews->count() }} avaliações)</p>
            </div>
        @endif
    </div>

    {{-- Lista de reviews --}}
    @if($agency->reviews->count())
        <div class="space-y-6">
            @foreach($agency->reviews as $review)
                <div class="bg-surface rounded-xl border border-border p-6">
                    {{-- Header da review --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-caixa-blue-light rounded-full flex items-center justify-center">
                                <span class="text-caixa-blue font-bold text-sm">{{ strtoupper(substr($review->reviewer_name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-text-primary text-sm">{{ $review->reviewer_name }}</p>
                                <p class="text-xs text-text-muted">{{ $review->review_date?->translatedFormat('d/m/Y \à\s H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>

                    {{-- Comentário --}}
                    @if($review->comment)
                        <p class="text-text-secondary text-sm leading-relaxed mb-4">{{ $review->comment }}</p>
                    @else
                        <p class="text-text-muted text-sm italic mb-4">Sem comentário</p>
                    @endif

                    {{-- Resposta existente ou formulário --}}
                    @if($review->reply)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-xs font-semibold text-green-700 mb-1">✓ Resposta enviada</p>
                            <p class="text-sm text-green-900">{{ $review->reply }}</p>
                        </div>
                    @else
                        <form action="{{ route('admin.agencies.reviews.reply', [$agency, $review]) }}" method="POST" class="mt-4">
                            @csrf
                            <label for="reply-{{ $review->id }}" class="block text-xs font-semibold text-text-primary mb-2">Responder a esta avaliação:</label>
                            <textarea
                                id="reply-{{ $review->id }}"
                                name="reply"
                                rows="3"
                                required
                                placeholder="Escreva sua resposta..."
                                class="w-full px-4 py-3 rounded-xl border border-border bg-surface text-sm text-text-primary placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent resize-none"
                            ></textarea>
                            <div class="flex justify-end mt-3">
                                <button type="submit" class="bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold text-sm px-6 py-2.5 rounded-lg transition-all duration-200 hover:shadow-lg">
                                    Enviar Resposta
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-surface rounded-xl border border-border">
            <svg class="w-12 h-12 text-text-muted mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <p class="text-text-secondary font-medium">Nenhuma avaliação encontrada para esta agência.</p>
            <p class="text-text-muted text-sm mt-1">Execute <code class="bg-surface-muted px-2 py-1 rounded text-xs">php artisan google:sync-reviews</code> para sincronizar.</p>
        </div>
    @endif

@endsection
