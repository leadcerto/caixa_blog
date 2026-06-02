<x-guest-layout>
    {{-- Status de sessão (ex: "Link de redefinição enviado") --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-lg font-bold text-slate-900 mb-6">Entrar no painel</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- E-mail --}}
        <div>
            <x-input-label for="email" value="E-mail" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email"
                          :value="old('email')" required autofocus autocomplete="username"
                          placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Senha --}}
        <div>
            <x-input-label for="password" value="Senha" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password"
                          required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Lembrar-me --}}
        <div>
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <span class="text-sm text-slate-600">Manter conectado</span>
            </label>
        </div>

        <div class="flex items-center justify-between pt-1">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-slate-500 hover:text-blue-600 transition-colors underline underline-offset-2">
                    Esqueci minha senha
                </a>
            @endif

            <x-primary-button>
                Entrar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
