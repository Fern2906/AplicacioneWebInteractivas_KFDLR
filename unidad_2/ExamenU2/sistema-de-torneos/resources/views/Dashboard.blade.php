<x-layouts.app title="Dashboard">
    @auth
        <flux:heading size="xl" level="1">
            Bienvenido, {{ auth()->user()->name }}
        </flux:heading>
    @else
        <flux:heading size="xl" level="1">
            Bienvenido
    </flux:heading>
        @endauth
    <flux:text class="mt-2 mb-6 text-base">
        Aquí tienes las novedades de hoy.
    </flux:text>
    <flux:separator variant="subtle" />

</x-layouts.app>