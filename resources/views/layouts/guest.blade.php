<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name','To-Do') }}</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="page-wrap grid place-items-center min-h-screen p-6">
        <div x-data="{ show: false }" x-init="show = true" x-transition.opacity.duration.500>
            {{ $slot }}
        </div>
    </body>
</html>