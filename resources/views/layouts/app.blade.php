<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="page-wrap">
        <header class="sticky top-0 z-40 border-b border-white/10 bg-black/30 backdrop-blur">
            <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
                <a href="{{ route('tasks.index') }}" class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-xl bg-violet-600"></div>
                    <span class="font-semibold">{{ config('app.name','To‑Do') }}</span>
                </a>
                @auth
                    <nav class="flex items-center gap-2">
                        <a href="{{ route('projects.index') }}" class="btn-ghost">Projetos</a>
                        <a href="{{ route('tasks.index') }}" class="btn-ghost">Tarefas</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn-primary">Sair</button></form>
                    </nav>
                @endauth
            </div>
        </header>
        <main class="mx-auto max-w-6xl px-4 py-8"> {{ $slot ?? '' }} </main>
    </body>
</html>