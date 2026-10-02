<x-layout title="Nueva Tarea">

    <div class="max-w-2xl mx-auto">
        <!-- Navegación de Regreso (Apple Back Button) -->
        <div class="mb-6">
            <a href="{{ route('task.index') }}"
               class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-neutral-500 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white transition-colors apple-press">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Volver al tablero</span>
            </a>
        </div>

        <!-- Tarjeta de Creación Estilo Modal Sheet de Apple -->
        <x-card class="p-6 sm:p-8">
            <div class="mb-6 pb-5 border-b border-black/[0.04] dark:border-white/[0.06]">
                <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#1d1d1f] dark:text-white">
                    Nueva Tarea
                </h1>
                <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                    Ingresa los detalles para planificar y organizar tu actividad.
                </p>
            </div>

            <form action="{{ route('task.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Título -->
                <x-input
                    name="titulo"
                    label="Título de la tarea"
                    placeholder="Ej. Diseñar la arquitectura de componentes"
                    required
                    autofocus
                />

                <!-- Descripción -->
                <x-textarea
                    name="descripcion"
                    label="Descripción (opcional)"
                    placeholder="Describe los requerimientos, notas o enlaces necesarios..."
                    rows="3"
                    hint="Puedes detallar especificaciones o pasos a seguir."
                />

                <!-- Estado Inicial y Prioridad -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-segmented-control
                        name="estado"
                        label="Estado inicial"
                        :options="$estados"
                        :value="request('estado', 'por_hacer')"
                        type="estado"
                        required
                    />

                    <x-segmented-control
                        name="prioridad"
                        label="Prioridad"
                        :options="$prioridades"
                        value="media"
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
                        :value="date('Y-m-d')"
                        required
                        hint="Establece la fecha límite para completar la tarea."
                    />
                </div>

                <!-- Acciones del Formulario -->
                <div class="pt-6 border-t border-black/[0.04] dark:border-white/[0.06] flex items-center justify-end gap-3">
                    <x-button :href="route('task.index')" variant="secondary" size="md">
                        Cancelar
                    </x-button>

                    <x-button type="submit" variant="primary" size="md">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        <span>Crear Tarea</span>
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>

</x-layout>
