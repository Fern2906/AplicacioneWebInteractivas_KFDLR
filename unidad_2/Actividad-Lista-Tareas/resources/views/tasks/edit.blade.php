<x-layout title="Editar Tarea">

    <div class="max-w-2xl mx-auto">
        <!-- Navegación de Regreso -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('task.index') }}"
               class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-neutral-500 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white transition-colors apple-press">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Volver al tablero</span>
            </a>

            <a href="{{ route('task.show', $tarea) }}"
               class="text-xs sm:text-sm font-medium text-[#0071e3] hover:underline apple-press">
                Ver detalle
            </a>
        </div>

        <!-- Tarjeta de Edición Apple Glass -->
        <x-card class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-6 pb-5 border-b border-black/[0.04] dark:border-white/[0.06]">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#1d1d1f] dark:text-white">
                        Editar Tarea
                    </h1>
                    <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                        Modifica los detalles, prioridad o fecha límite de la tarea.
                    </p>
                </div>

                <!-- Botón eliminar rápido en el header -->
                <form action="{{ route('task.destroy', $tarea) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea definitivamente?');">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="destructive" size="sm">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 6h18"/>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                        </svg>
                        <span>Eliminar</span>
                    </x-button>
                </form>
            </div>

            <form action="{{ route('task.update', $tarea) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Título -->
                <x-input
                    name="titulo"
                    label="Título de la tarea"
                    :value="$tarea->titulo"
                    placeholder="Ej. Revisar entregables finales"
                    required
                    autofocus
                />

                <!-- Descripción -->
                <x-textarea
                    name="descripcion"
                    label="Descripción (opcional)"
                    :value="$tarea->descripcion"
                    placeholder="Describe los requerimientos, notas o enlaces necesarios..."
                    rows="3"
                />

                <!-- Estado y Prioridad -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-segmented-control
                        name="estado"
                        label="Estado"
                        :options="$estados"
                        :value="$tarea->estado"
                        type="estado"
                        required
                    />

                    <x-segmented-control
                        name="prioridad"
                        label="Prioridad"
                        :options="$prioridades"
                        :value="$tarea->prioridad"
                        type="prioridad"
                        required
                    />
                </div>

                <!-- Fecha de Vencimiento -->
                <div class="max-w-xs">
                    <x-input
                        type="date"
                        name="vencimiento"
                        label="Fecha de vencimiento"
                        :value="$tarea->vencimiento ? \Carbon\Carbon::parse($tarea->vencimiento)->format('Y-m-d') : ''"
                        required
                    />
                </div>

                <!-- Acciones del Formulario -->
                <div class="pt-6 border-t border-black/[0.04] dark:border-white/[0.06] flex items-center justify-end gap-3">
                    <x-button :href="route('task.index')" variant="secondary" size="md">
                        Cancelar
                    </x-button>

                    <x-button type="submit" variant="primary" size="md">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span>Guardar Cambios</span>
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>

</x-layout>
