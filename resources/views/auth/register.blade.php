<x-guest-layout>
    <div class="max-w-md mx-auto card-glass p-6">
        <h1 class="h1 mb-2">Criar conta</h1>
        <p class="text-white/70 mb-6">Comece a organizar seu dia.</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <x-ui.input name="name" placeholder="Seu nome" required />
            <x-ui.input type="email" name="email" placeholder="Seu e-mail" required />
            <x-ui.input type="password" name="password" placeholder="Senha" required />
            <x-ui.input type="password" name="password_confirmation" placeholder="Confirmar senha" required />
            <x-ui.button type="submit" class="w-full">Criar conta</x-ui.button>
        </form>

        <p class="mt-4 text-center text-sm text-white/80">
            Já tem conta? <a href="{{ route('login') }}" class="text-cyan-300 hover:underline">Entre</a>
        </p>
    </div>
</x-guest-layout>