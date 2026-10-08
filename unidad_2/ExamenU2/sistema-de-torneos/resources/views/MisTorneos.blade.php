<x-layouts.app title="Mis Torneos">
    <flux:heading size="xl" level="1">Mis Torneos</flux:heading>
    <flux:text class="mt-2 mb-6">Aquí puedes ver los torneos en los que estás inscrito.</flux:text>
    <flux:separator variant="subtle" class="mb-6" />

    @if($inscripciones->isEmpty())
        <flux:callout variant="info" icon="information-circle">
            <flux:callout.heading>Sin torneos</flux:callout.heading>
            <flux:callout.text>No estás inscrito en ningún torneo.</flux:callout.text>
        </flux:callout>
    @else
        <div class="space-y-4">
            @foreach($inscripciones as $inscripcion)
                @php $torneo = $inscripcion->torneo; @endphp
                <flux:card>
                    <flux:card.header>
                        <flux:card.heading>{{ $torneo->nombre }}</flux:card.heading>
                        <flux:card.actions>
                            @if(!$torneo->fecha_futura->isPast())
                                <form method="POST" action="{{ route('inscripcion.destroy', $inscripcion) }}">
                                    @csrf @method('DELETE')
                                    <flux:button type="submit" size="sm" variant="danger">Cancelar inscripción</flux:button>
                                </form>
                            @else
                                <flux:badge color="zinc">Torneo finalizado</flux:badge>
                            @endif
                        </flux:card.actions>
                    </flux:card.header>
                    <flux:card.body>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <flux:text size="sm" class="text-zinc-500">Juego</flux:text>
                                <flux:text>{{ $torneo->juego }}</flux:text>
                            </div>
                            <div>
                                <flux:text size="sm" class="text-zinc-500">Fecha</flux:text>
                                <flux:text>{{ $torneo->fecha_futura->format('d/m/Y') }}</flux:text>
                            </div>
                            <div>
                                <flux:text size="sm" class="text-zinc-500">Estado</flux:text>
                                <flux:badge :color="$torneo->estado ? 'green' : 'red'">{{ $torneo->estado ? 'Activo' : 'Cerrado' }}</flux:badge>
                            </div>
                        </div>
                    </flux:card.body>
                </flux:card>
            @endforeach
        </div>
    @endif
</x-layouts.app>
