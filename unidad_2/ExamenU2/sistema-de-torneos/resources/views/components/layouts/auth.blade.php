<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        @fluxAppearance
        @livewireStyles
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-900 antialiased">

        <div class="flex min-h-screen flex-col items-center justify-center px-4 py-12">

            <div class="mb-8 text-center">
                <flux:heading size="xl">
                    {{ config('app.name', 'Torneos') }}
                </flux:heading>
                @isset($subheading)
                    <flux:subheading class="mt-1">{{ $subheading }}</flux:subheading>
                @endisset
            </div>

            <div class="w-full max-w-sm">
                <flux:card body="inset" variant="soft" size="lg">
                    {{ $slot }}
                </flux:card>
            </div>

        </div>
        @fluxScripts
        @livewireScripts
    </body>
</html>
