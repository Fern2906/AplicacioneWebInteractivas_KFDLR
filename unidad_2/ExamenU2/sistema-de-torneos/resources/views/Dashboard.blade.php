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
    <div class="m-5 grid-cols-4 gap-6 sm:grid-cols-1">
        @foreach ($data as $torneo)
            <x-torneo-card :torneo="$torneo" />
        @endforeach
        </div>
</x-layouts.app>