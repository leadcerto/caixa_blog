<x-guest-layout>
    <h2 class="text-lg font-bold text-slate-900 mb-6">Criar conta</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Nome --}}
        <div>
            <x-input-label for="name" value="Nome completo" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name"
                          :value="old('name')" required autofocus autocomplete="name"
                          placeholder="Seu nome" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- E-mail --}}
        <div>
            <x-input-label for="email" value="E-mail" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email"
                          :value="old('email')" required autocomplete="username"
                          placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Senha --}}
        <div>
            <x-input-label for="password" value="Senha" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password"
                          required autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirmar senha --}}
        <div>
            <x-input-label for="password_confirmation" value="Confirmar senha" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="password_confirmation" class="block mt-1.5 w-full" type="password"
                          name="password_confirmation" required autocomplete="new-password"
                          placeholder="Repita a senha" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-1">
            <a href="{{ route('login') }}"
               class="text-sm text-slate-500 hover:text-blue-600 transition-colors underline underline-offset-2">
                Já tenho conta
            </a>

            <x-primary-button>
                Criar conta
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
