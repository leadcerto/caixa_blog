<section id="cadastro">
    <h2 class="text-2xl font-extrabold text-text-primary mb-2 pb-3 border-b-2 border-caixa-blue">
        {{ $heading }}
    </h2>
    <p class="text-text-secondary text-sm mb-6">
        {{ $subheading }}
    </p>

    <div class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-xl p-4 mb-6 text-sm text-text-secondary">
        <strong class="text-text-primary">Ao enviar este formulário, você declara estar ciente de que:</strong>
        <ul class="list-disc list-inside mt-2 space-y-1">
            @foreach($declarations as $declaration)
            <li>{{ $declaration }}</li>
            @endforeach
        </ul>
    </div>

    <form action="{{ route('contato.store') }}" method="POST" class="bg-surface border border-border rounded-2xl p-6 sm:p-8 space-y-5">
        @csrf
        <input type="hidden" name="page_name" value="{{ $pageName }}">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="contact-name" class="block text-sm font-semibold text-text-primary mb-1">Nome completo</label>
                <input id="contact-name" type="text" name="name" required placeholder="Seu nome"
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
            </div>
            <div>
                <label for="contact-email" class="block text-sm font-semibold text-text-primary mb-1">E-mail</label>
                <input id="contact-email" type="email" name="email" required placeholder="seu@email.com"
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
            </div>
            <div>
                <label for="contact-whatsapp" class="block text-sm font-semibold text-text-primary mb-1">WhatsApp</label>
                <input id="contact-whatsapp" type="tel" name="whatsapp" required placeholder="(21) 99999-9999"
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
            </div>
            <div>
                <label for="horario" class="block text-sm font-semibold text-text-primary mb-1">Melhor horário</label>
                <select id="horario" name="horario" class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue">
                    <option value="">Selecione</option>
                    <option>08h às 12h</option>
                    <option>12h às 16h</option>
                    <option>16h às 20h</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-text-primary mb-1">Finalidade do imóvel</label>
                <div class="flex flex-wrap gap-3">
                    @foreach(['Comprar para morar', 'Comprar e vender', 'Comprar para alugar'] as $finalidade)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="finalidade" value="{{ $finalidade }}" class="accent-caixa-blue">
                        <span class="text-sm text-text-secondary">{{ $finalidade }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="contact-message" class="block text-sm font-semibold text-text-primary mb-1">Mensagem (opcional)</label>
                <textarea id="contact-message" name="message" rows="3" placeholder="Descreva o imóvel que você está procurando..."
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue resize-none"></textarea>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-caixa-blue hover:bg-caixa-blue-dark text-white font-bold text-lg py-4 rounded-xl transition-colors">
            Quero ser atendido gratuitamente →
        </button>
        <p class="text-xs text-text-muted text-center">Atendimento 100% gratuito — nenhuma comissão será cobrada</p>
    </form>
</section>
