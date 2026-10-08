@props(['torneo', 'yaInscrito' => false])

<flux:card>
    <flux:card.header>
        <flux:card.heading size="lg">
            {{ $torneo['nombre'] }}
        </flux:card.heading>
        @auth
            @if(auth()->user()->rol === 'administrador')
                <flux:card.actions>
                    <flux:button
                        size="sm"
                        variant="outline"
                        icon="pencil-square"
                        href="{{ route('tournamentform.edit', $torneo['id']) }}"
                    >
                        Editar
                    </flux:button>
                    <form method="POST" action="{{ route('tournamentform.destroy', $torneo['id']) }}">
                        @csrf
                        @method('DELETE')
                        <flux:button type="submit" size="sm" variant="danger" icon="trash">Eliminar</flux:button>
                    </form>
                </flux:card.actions>
            @elseif(auth()->user()->rol === 'jugador')
                <flux:card.actions>
                    @if($yaInscrito || ($torneo['ya_inscrito'] ?? false))
                        <flux:badge color="green">Ya inscrito</flux:badge>
                    @elseif($torneo['estado'] && !\Carbon\Carbon::parse($torneo['fecha_futura'])->isPast() && ($torneo['inscripciones_count'] ?? 0) < $torneo['cupo'])
                        <form method="POST" action="{{ route('inscripcion.store', $torneo['id']) }}">
                            @csrf
                            <flux:button type="submit" size="sm" variant="primary" icon="plus-circle">Inscribirse</flux:button>
                        </form>
                    @else
                        <flux:badge color="zinc">No disponible</flux:badge>
                    @endif
                </flux:card.actions>
            @endif
        @endauth
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

        <div class="flex justify-between items-center w-full">
            <div>
                <flux:text size="sm" class="text-zinc-500">Descripción</flux:text>
                <flux:text class="mt-1">
                    {{ $torneo['descripcion'] ?: 'Sin descripción' }}
                </flux:text>
            </div>
            <flux:button size="sm" variant="outline" icon="eye" href="{{ route('torneo.show', $torneo['id']) }}">
                Ver
            </flux:button>
        </div>
    </flux:card.body>
</flux:card>
