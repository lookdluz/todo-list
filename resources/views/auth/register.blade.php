<x-guest-layout>
    <div class="auth-wrap">
        <h1 class="auth-h1">Criar conta ✨</h1>
        <p class="auth-sub">Organize seu dia e alcance mais objetivos</p>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            <x-ui.input name="name" placeholder="Nome completo" required />
            <x-ui.input type="email" name="email" placeholder="E-mail" required />
            <x-ui.input type="password" name="password" placeholder="Senha" required />
            <x-ui.input type="password" name="password_confirmation" placeholder="Confirmar senha" required />
            <x-ui.button type="submit" class="w-full">Registrar</x-ui.button>
        </form>

        <p class="mt-6 text-center text-sm text-white/80">
            Já tem conta?
            <a href="{{ route('login') }}" class="auth-link">Entrar</a>
        </p>
    </div>
</x-guest-layout>