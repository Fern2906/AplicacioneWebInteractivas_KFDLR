<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
        @livewireStyles
    </head>
    <body class="min-h-screen antialiased">
        <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:brand href="#" logo="https://uxwing.com/wp-content/themes/uxwing/download/sport-and-awards/medal-color-icon.png" name="Torneos" class="max-lg:hidden dark:hidden" />
            <flux:brand href="#" logo="https://uxwing.com/wp-content/themes/uxwing/download/sport-and-awards/medal-color-icon.png" name="Torneos" class="max-lg:hidden! hidden dark:flex" />
            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" href="{{ route('dashboard') }}" current>Inicio</flux:navbar.item>
                @auth
                    @if(auth()->user()->rol === 'administrador')
                        <flux:navbar.item icon="calendar" href="{{ route('tournamentform') }}">
                            Crear torneo
                        </flux:navbar.item>
                    @elseif(auth()->user()->rol === 'jugador')
                        <flux:navbar.item icon="document-text" href="{{ route('mis-torneos') }}">
                            Mis Torneos
                        </flux:navbar.item>
                    @endif
                @endauth
            </flux:navbar>
            <flux:spacer />
            <flux:navbar class="me-4">
                <flux:navbar.item icon="magnifying-glass" href="#" />
                <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#"/>
                <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#"/>
            </flux:navbar>
            @auth
                <flux:dropdown position="bottom" align="end">
                    <flux:profile name="{{ auth()->user()->name }}" />
                    <flux:menu>
                        <flux:menu.separator />
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-red-600 dark:text-red-400">
                                Cerrar sesión
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @else
                <flux:navbar class="-mb-px max-lg:hidden">
                    <flux:navbar.item href="{{ route('login') }}" icon="user">
                        Iniciar sesión
                    </flux:navbar.item>
                </flux:navbar>
            @endauth
        </flux:header>

        @if(session('success') || session('error'))
            <div class="fixed top-16 right-4 z-50 max-w-sm w-full space-y-2 pointer-events-auto">
                @if(session('success'))
                    <flux:callout variant="success" icon="check-circle" class="shadow-lg">
                        <flux:callout.text>{{ session('success') }}</flux:callout.text>
                    </flux:callout>
                @endif

                @if(session('error'))
                    <flux:callout variant="danger" icon="x-circle" class="shadow-lg">
                        <flux:callout.text>{{ session('error') }}</flux:callout.text>
                    </flux:callout>
                @endif
            </div>
        @endif

        {{-- Sidebar para móviles --}}
        <flux:sidebar sticky collapsible="mobile" class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.header>
                <flux:sidebar.brand
                    href="#"
                    logo="https://uxwing.com/wp-content/themes/uxwing/download/sport-and-awards/medal-color-icon.png"
                    logo:dark="https://uxwing.com/wp-content/themes/uxwing/download/sport-and-awards/medal-color-icon.png"
                    name="Torneos"
                />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="home" href="{{ route('dashboard') }}" current>Inicio</flux:sidebar.item>
                @auth
                    @if(auth()->user()->rol === 'administrador')
                        <flux:sidebar.item icon="calendar" href="{{ route('tournamentform') }}">
                            Crear torneo
                        </flux:sidebar.item>
                    @elseif(auth()->user()->rol === 'jugador')
                        <flux:sidebar.item icon="document-text" href="{{ route('mis-torneos') }}">
                            Mis Torneos
                        </flux:sidebar.item>
                    @endif
                @endauth
            </flux:sidebar.nav>

            <flux:sidebar.spacer />

            <flux:sidebar.nav>
                @auth
                    <flux:sidebar.item icon="cog-6-tooth" href="#">Ajustes</flux:sidebar.item>
                @endauth
                <flux:sidebar.item icon="information-circle" href="#">Ayuda</flux:sidebar.item>

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:sidebar.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-red-600 dark:text-red-400">
                            Cerrar sesión
                        </flux:sidebar.item>
                    </form>
                @else
                    <flux:sidebar.item href="{{ route('login') }}" icon="user">
                        Iniciar sesión
                    </flux:sidebar.item>
                @endauth
            </flux:sidebar.nav>
        </flux:sidebar>

        <flux:main container>
            {{ $slot }}
        </flux:main>

        @fluxScripts
        @livewireScripts
    </body>
</html>
