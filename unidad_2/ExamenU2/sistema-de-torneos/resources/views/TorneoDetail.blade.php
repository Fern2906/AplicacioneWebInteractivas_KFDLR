<x-layouts.app :title="$torneo->nombre">
    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-4">
            <flux:button href="{{ route('dashboard') }}" variant="ghost" icon="arrow-left" size="sm">Volver</flux:button>
        </div>
        <flux:heading size="xl" level="1">{{ $torneo->nombre }}</flux:heading>
        <flux:separator variant="subtle" class="my-6" />
        <flux:card class="mb-6">
            <flux:card.body>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <flux:text size="sm" class="text-zinc-500">Juego</flux:text>
                        <flux:text class="mt-1">{{ $torneo->juego }}</flux:text>
                    </div>
                    <div>
                        <flux:text size="sm" class="text-zinc-500">Fecha</flux:text>
                        <flux:text class="mt-1">{{ $torneo->fecha_futura->format('d/m/Y H:i') }}</flux:text>
                    </div>
                    <div>
                        <flux:text size="sm" class="text-zinc-500">Cupo</flux:text>
                        <flux:text class="mt-1">{{ $torneo->inscripciones->count() }} / {{ $torneo->cupo }}</flux:text>
                    </div>
                    <div>
                        <flux:text size="sm" class="text-zinc-500">Estado</flux:text>
                        <flux:badge :color="$torneo->estado ? 'green' : 'red'" class="mt-1">{{ $torneo->estado ? 'Activo' : 'Cerrado' }}</flux:badge>
                    </div>
                    @if($torneo->descripcion)
                        <div class="sm:col-span-2">
                            <flux:text size="sm" class="text-zinc-500">Descripción</flux:text>
                            <flux:text class="mt-1">{{ $torneo->descripcion }}</flux:text>
                        </div>
                    @endif
                </div>
            </flux:card.body>
        </flux:card>

        <flux:heading size="lg" level="2" class="mb-4">Jugadores inscritos</flux:heading>
        @if($torneo->inscripciones->isEmpty())
            <flux:callout variant="info" icon="information-circle">
                <flux:callout.text>No hay jugadores inscritos todavía.</flux:callout.text>
            </flux:callout>
        @else
            <div class="overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
                <table class="w-full text-sm">
                    <thead class="bg-zinc-50 dark:bg-zinc-800">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-zinc-600 dark:text-zinc-400">Jugador</th>
                            <th class="px-4 py-3 text-left font-medium text-zinc-600 dark:text-zinc-400">Email</th>
                            <th class="px-4 py-3 text-left font-medium text-zinc-600 dark:text-zinc-400">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                        @foreach($torneo->inscripciones as $inscripcion)
                            <tr class="bg-white dark:bg-zinc-900">
                                <td class="px-4 py-3 text-zinc-800 dark:text-zinc-200">{{ $inscripcion->user->name }}</td>
                                <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400">{{ $inscripcion->user->email }}</td>
                                <td class="px-4 py-3">
                                    @auth
                                        @if(auth()->user()->rol === 'administrador' || (!$torneo->estaVencida() && $inscripcion->user_id === auth()->id()))
                                            <form method="POST" action="{{ route('inscripcion.destroy', $inscripcion) }}">
                                                @csrf
                                                @method('DELETE')
                                                <flux:button type="submit" size="sm" variant="filled" class="bg-red-600 hover:bg-red-700 text-white">
                                                    {{ auth()->user()->rol === 'administrador' ? 'Dar de baja' : 'Cancelar inscripción' }}
                                                </flux:button>
                                            </form>
                                        @endif
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.app>
