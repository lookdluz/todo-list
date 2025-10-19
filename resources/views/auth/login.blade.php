<x-guest-layout>
    <div class="max-w-md mx-auto card-glass p-6">
        <h1 class="h1 mb-2">Bem-vindo de volta</h1>
        <p class="text-white/70 mb-6">Entre para gerenciar suas tarefas.</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <x-ui.input type="email" name="email" placeholder="Seu e-mail" required autofocus />
            <x-ui.input type="password" name="password" placeholder="Senha" required />
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center gap-2 text-sm text-white/80">
                    <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/10">
                        Lembrar de mim
                </label>
                @if (Route::has('password.request'))
                    <a class="text-cyan-300 hover:underline text-sm" href="{{ route('password.request') }}">Esqueceu a senha?</a>
                @endif
            </div>
            <x-ui.button type="submit" class="w-full">Entrar</x-ui.button>
        </form>

        <p class="mt-4 text-center text-sm text-white/80">
            Não tem uma conta? <a href="{{ route('register') }}" class="text-cyan-300 hover:underline">Registre-se</a>
        </p>
    </div>
</x-guest-layout>