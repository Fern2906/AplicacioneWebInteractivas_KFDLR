<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ filled($title ?? null) ? $title.' — Portafolio' : 'Portafolio' }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @fluxAppearance
        @livewireStyles
    </head>
    <body class="flex min-h-screen flex-col bg-gray-50 text-gray-800 antialiased dark:bg-neutral-900 dark:text-white">
        <x-portfolio.navbar />

        <main class="flex-1">
            {{ $slot }}
        </main>

        <x-portfolio.footer />

        @livewireScripts
    </body>
</html>
