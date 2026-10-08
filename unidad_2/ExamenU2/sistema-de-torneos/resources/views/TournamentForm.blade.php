<x-layouts.app :title="isset($torneo) ? 'Editar Torneo' : 'Crear Torneo'">

    <div class="max-w-2xl mx-auto py-8 px-4">

        <div class="mb-6">
            <flux:heading size="xl" level="1">
                {{ isset($torneo) ? 'Editar torneo' : 'Crear nuevo torneo' }}
            </flux:heading>
            <flux:subheading>
                {{ isset($torneo) ? 'Modifica los datos del torneo.' : 'Completa los datos para publicar tu torneo.' }}
            </flux:subheading>
        </div>

        <flux:separator class="mb-8" />

        @if(isset($torneo))
            <form method="POST" action="{{ route('tournamentform.update', $torneo) }}" class="space-y-6">
                @csrf
                @method('PUT')
        @else
            <form method="POST" action="{{ route('tournamentform.store') }}" class="space-y-6">
                @csrf
        @endif

            <flux:field>
                <flux:label badge="Requerido">Nombre del torneo</flux:label>
                <flux:input
                    name="nombre"
                    :value="old('nombre', $torneo->nombre ?? '')"
                    placeholder="Ej. Copa Verano 2026"
                    required
                    clearable
                />
                <flux:description>El nombre que verán los participantes.</flux:description>
                <flux:error name="nombre" />
            </flux:field>

            <flux:field>
                <flux:label badge="Requerido">Juego</flux:label>
                <flux:input
                    name="juego"
                    :value="old('juego', $torneo->juego ?? '')"
                    placeholder="Ej. League of Legends"
                    required
                    clearable
                />
                <flux:description>Nombre del videojuego del torneo.</flux:description>
                <flux:error name="juego" />
            </flux:field>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <flux:field>
                    <flux:label badge="Requerido">Fecha del torneo</flux:label>
                    <flux:input
                        type="date"
                        name="fecha_futura"
                        :value="old('fecha_futura', isset($torneo) ? $torneo->fecha_futura?->format('Y-m-d') : '')"
                        required
                    />
                    <flux:error name="fecha_futura" />
                </flux:field>

                <flux:field>
                    <flux:label badge="Requerido">Cupo máximo</flux:label>
                    <flux:input
                        type="number"
                        name="cupo"
                        :value="old('cupo', $torneo->cupo ?? 16)"
                        min="2"
                        max="100"
                        required
                        clearable
                    />
                    <flux:description>Mínimo 2, máximo 100 participantes.</flux:description>
                    <flux:error name="cupo" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label>Descripción</flux:label>
                <flux:textarea
                    name="descripcion"
                    rows="4"
                    placeholder="Describe las reglas, premios o cualquier detalle relevante..."
                >{{ old('descripcion', $torneo->descripcion ?? '') }}</flux:textarea>
                <flux:error name="descripcion" />
            </flux:field>

            <flux:field>
                <flux:label>Estado</flux:label>
                <flux:select name="estado" :value="old('estado', isset($torneo) ? ($torneo->estado ? '1' : '0') : '1')">
                    <flux:select.option value="1">Activo</flux:select.option>
                    <flux:select.option value="0">Inactivo</flux:select.option>
                </flux:select>
                <flux:description>Un torneo inactivo no es visible para los jugadores.</flux:description>
                <flux:error name="estado" />
            </flux:field>

            @if(isset($inscritos) && $inscritos->isNotEmpty())
                <flux:separator />
                <div>
                    <flux:heading size="lg">Jugadores inscritos</flux:heading>
                    <flux:table class="mt-4">
                        <flux:table.head>
                            <flux:table.row>
                                <flux:table.cell>Jugador</flux:table.cell>
                                <flux:table.cell>Email</flux:table.cell>
                                <flux:table.cell>Acción</flux:table.cell>
                            </flux:table.row>
                        </flux:table.head>
                        <flux:table.body>
                            @foreach($inscritos as $inscripcion)
                                <flux:table.row>
                                    <flux:table.cell>{{ $inscripcion->user->name }}</flux:table.cell>
                                    <flux:table.cell>{{ $inscripcion->user->email }}</flux:table.cell>
                                    <flux:table.cell>
                                        <form method="POST" action="{{ route('inscripcion.destroy', $inscripcion) }}">
                                            @csrf @method('DELETE')
                                            <flux:button type="submit" size="sm" variant="danger">Dar de baja</flux:button>
                                        </form>
                                    </flux:table.cell>
                                </flux:table.row>
                            @endforeach
                        </flux:table.body>
                    </flux:table>
                </div>
            @endif

            <div class="flex items-center justify-end gap-3 pt-2">
                <flux:button href="{{ route('dashboard') }}" variant="ghost">
                    Cancelar
                </flux:button>
                <flux:button type="submit" variant="primary">
                    {{ isset($torneo) ? 'Guardar cambios' : 'Crear torneo' }}
                </flux:button>
            </div>

        </form>
    </div>
</x-layouts.app>
