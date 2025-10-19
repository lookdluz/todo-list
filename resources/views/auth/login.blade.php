<x-guest-layout>
    <div class="auth-wrap">
        <h1 class="auth-h1">Bem-vindo de volta 👋</h1>
        <p class="auth-sub">Entre para continuar organizando suas tarefas</p>

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <x-ui.input type="email" name="email" placeholder="E-mail" required autofocus />
            <x-ui.input type="password" name="password" placeholder="Senha" required />

            <div class="flex items-center justify-between text-sm text-white/70">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/10">
                        Lembrar
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link">Esqueceu a senha?</a>
                @endif
            </div>

            <x-ui.button type="submit" class="w-full">Entrar</x-ui.button>
        </form>

        <p class="mt-6 text-center text-sm text-white/80">
            Não tem uma conta?
            <a href="{{ route('register') }}" class="auth-link">Registre-se</a>
        </p>
    </div>
</x-guest-layout>