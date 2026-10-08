@props(['torneo'])

<flux:card>
    <flux:card.header>
        <flux:card.heading size="lg">
            {{ $torneo['nombre'] }}
        </flux:card.heading>
        @if(auth()->check())
            @if(auth()->user()->rol === 'administrador')
                <flux:card.actions>
                    <flux:button size="sm" variant="outline">
                        Editar
                    </flux:button>
                </flux:card.actions>
            @else
                <flux:card.actions>
                    <flux:button size="sm" variant="primary" icon="plus-circle">
                        Inscribirse
                    </flux:button>
                </flux:card.actions>
            @endif
        @endif
    </flux:card.header>

    <flux:card.body>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <flux:text size="sm" class="text-zinc-500">Juego</flux:text>
                <flux:text class="mt-1">{{ $torneo['juego'] }}</flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">Fecha del torneo</flux:text>
                <flux:text class="mt-1">{{ $torneo['fecha_futura'] }}</flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">Cupo</flux:text>
                <flux:text class="mt-1">{{ $torneo['cupo'] }} jugadores</flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">Inscritos</flux:text>
                {{ $torneo['inscripciones_count'] ?? $torneo['inscritos_count'] ?? 0 }} / {{ $torneo['cupo'] }} jugadores
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">Estado</flux:text>
                <flux:badge
                    :color="$torneo['estado'] ? 'green' : 'red'"
                    class="mt-1"
                >
                    {{ $torneo['estado'] ? 'Activo' : 'Cerrado' }}
                </flux:badge>
            </div>
        </div>

        <flux:separator variant="subtle" class="my-4" />

        <div>
            <flux:text size="sm" class="text-zinc-500">Descripción</flux:text>
            <flux:text class="mt-1">
                {{ $torneo['descripcion'] ?: 'Sin descripción' }}
            </flux:text>
        </div>
    </flux:card.body>
</flux:card>