@props(['torneo', 'yaInscrito' => false])

<flux:card class="h-full flex flex-col justify-between">
    <flux:card.header class="flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <flux:card.heading size="lg" class="break-words max-w-full">
            {{ $torneo['nombre'] }}
        </flux:card.heading>

        @auth
            @if(auth()->user()->rol === 'administrador')
                <flux:card.actions class="flex-wrap items-center gap-2 w-full sm:w-auto justify-end">
                    <flux:button
                        size="sm"
                        variant="outline"
                        icon="pencil-square"
                        href="{{ route('tournamentform.edit', $torneo['id']) }}"
                    >
                        Editar
                    </flux:button>
                    <form method="POST" action="{{ route('tournamentform.destroy', $torneo['id']) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <flux:button type="submit" size="sm" variant="danger" icon="trash">
                            Eliminar
                        </flux:button>
                    </form>
                </flux:card.actions>
            @elseif(auth()->user()->rol === 'jugador')
                <flux:card.actions class="w-full sm:w-auto flex justify-end">
                    @if($yaInscrito || ($torneo['ya_inscrito'] ?? false))
                        <flux:badge color="green">Ya inscrito</flux:badge>
                    @elseif($torneo['estado'] && !\Carbon\Carbon::parse($torneo['fecha_futura'])->isPast() && ($torneo['inscripciones_count'] ?? 0) < $torneo['cupo'])
                        <form method="POST" action="{{ route('inscripcion.store', $torneo['id']) }}" class="w-full sm:w-auto">
                            @csrf
                            <flux:button type="submit" size="sm" variant="primary" icon="plus-circle" class="w-full sm:w-auto">
                                Inscribirse
                            </flux:button>
                        </form>
                    @else
                        <flux:badge color="zinc">No disponible</flux:badge>
                    @endif
                </flux:card.actions>
            @endif
        @endauth
    </flux:card.header>

    <flux:card.body class="flex-1 flex flex-col justify-between pt-4">
        {{-- Rejilla de información --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <flux:text size="sm" class="text-zinc-500">Juego</flux:text>
                <flux:text class="mt-1 font-medium truncate">{{ $torneo['juego'] }}</flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">Fecha del torneo</flux:text>
                <flux:text class="mt-1 font-medium">{{ $torneo['fecha_futura'] }}</flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">Cupo</flux:text>
                <flux:text class="mt-1 font-medium">{{ $torneo['cupo'] }} jugadores</flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">Inscritos</flux:text>
                <flux:text class="mt-1 font-medium">
                    {{ $torneo['inscripciones_count'] ?? $torneo['inscritos_count'] ?? 0 }} / {{ $torneo['cupo'] }} jugadores
                </flux:text>
            </div>

            <div class="sm:col-span-2">
                <flux:text size="sm" class="text-zinc-500">Estado</flux:text>
                <div class="mt-1">
                    <flux:badge
                        :color="$torneo['estado'] ? 'green' : 'red'"
                    >
                        {{ $torneo['estado'] ? 'Activo' : 'Cerrado' }}
                    </flux:badge>
                </div>
            </div>
        </div>

        <flux:separator variant="subtle" class="my-4" />

        {{-- Sección inferior con descripción y botón Ver --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 w-full">
            <div class="flex-1 min-w-0">
                <flux:text size="sm" class="text-zinc-500">Descripción</flux:text>
                <flux:text class="mt-1 line-clamp-2">
                    {{ $torneo['descripcion'] ?: 'Sin descripción' }}
                </flux:text>
            </div>
            <flux:button
                size="sm"
                variant="outline"
                icon="eye"
                href="{{ route('torneo.show', $torneo['id']) }}"
                class="w-full sm:w-auto shrink-0"
            >
                Ver
            </flux:button>
        </div>
    </flux:card.body>
</flux:card>
