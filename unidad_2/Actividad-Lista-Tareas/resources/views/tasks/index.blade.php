<x-layout title="Tablero de Tareas">

    @php
        $totalTareas = $tareasPorEstado->flatten()->count();
        $hayFiltrosActivos = !empty($filtros['q']) || !empty($filtros['estado']) || !empty($filtros['prioridad']);
    @endphp

    <!-- Cabecera de Página (Apple Style Hero) -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#1d1d1f] dark:text-white">
                    Tablero de Tareas
                </h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-black/[0.05] dark:bg-white/[0.1] text-neutral-600 dark:text-neutral-300 border border-black/[0.04] dark:border-white/[0.06]">
                    {{ $totalTareas }} {{ $totalTareas === 1 ? 'tarea' : 'tareas' }}
                </span>
            </div>
            <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                Visualiza y gestiona tu flujo de trabajo de forma continua y fluida.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <x-button :href="route('task.create')" variant="primary" size="md">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Nueva Tarea</span>
            </x-button>
        </div>
    </div>

    <!-- Barra de Filtros y Búsqueda (Apple Toolbar) -->
    <div class="mb-8 p-3 sm:p-4 rounded-2xl apple-glass-card border border-black/[0.06] dark:border-white/[0.08] shadow-[0_2px_12px_-2px_rgba(0,0,0,0.03)]">
        <form method="GET" action="{{ route('task.index') }}" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">

            <!-- Buscador en tiempo real / query q -->
            <div class="relative flex-1 min-w-[240px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-neutral-400">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
                <input type="text"
                       name="q"
                       value="{{ $filtros['q'] ?? '' }}"
                       placeholder="Buscar por título..."
                       class="w-full pl-9 pr-8 py-2 rounded-xl text-xs sm:text-sm bg-black/[0.03] dark:bg-white/[0.05] border border-black/10 dark:border-white/10 text-[#1d1d1f] dark:text-white placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#0071e3]/30 focus:border-[#0071e3] transition-all">
                @if (!empty($filtros['q']))
                    <a href="{{ route('task.index', array_merge($filtros, ['q' => null])) }}"
                       class="absolute inset-y-0 right-0 pr-3 flex items-center text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
            </div>

            <!-- Filtros Segmentados -->
            <div class="flex flex-wrap sm:flex-nowrap items-center gap-2">
                <!-- Selector de Estado -->
                <div class="relative">
                    <select name="estado"
                            onchange="this.form.submit()"
                            class="appearance-none pl-3 pr-8 py-2 rounded-xl text-xs sm:text-sm font-medium bg-black/[0.03] dark:bg-white/[0.05] border border-black/10 dark:border-white/10 text-neutral-700 dark:text-neutral-200 focus:outline-none focus:ring-2 focus:ring-[#0071e3]/30 cursor-pointer transition-all">
                        <option value="">Todos los estados</option>
                        @foreach ($estados as $clave => $etiqueta)
                            <option value="{{ $clave }}" {{ ($filtros['estado'] ?? '') === $clave ? 'selected' : '' }}>
                                {{ $etiqueta }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none text-neutral-400">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Selector de Prioridad -->
                <div class="relative">
                    <select name="prioridad"
                            onchange="this.form.submit()"
                            class="appearance-none pl-3 pr-8 py-2 rounded-xl text-xs sm:text-sm font-medium bg-black/[0.03] dark:bg-white/[0.05] border border-black/10 dark:border-white/10 text-neutral-700 dark:text-neutral-200 focus:outline-none focus:ring-2 focus:ring-[#0071e3]/30 cursor-pointer transition-all">
                        <option value="">Todas las prioridades</option>
                        @foreach ($prioridades as $clave => $etiqueta)
                            <option value="{{ $clave }}" {{ ($filtros['prioridad'] ?? '') === $clave ? 'selected' : '' }}>
                                Prioridad: {{ $etiqueta }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none text-neutral-400">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Botón de Filtrar (manual si no usaron onchange) -->
                <x-button type="submit" variant="secondary" size="sm">
                    Filtrar
                </x-button>

                <!-- Limpiar filtros -->
                @if ($hayFiltrosActivos)
                    <x-button :href="route('task.index')" variant="ghost" size="sm" title="Quitar todos los filtros">
                        Limpiar
                    </x-button>
                @endif
            </div>
        </form>
    </div>

    <!-- Si no hay ninguna tarea en absoluto en el sistema -->
    @if ($totalTareas === 0 && !$hayFiltrosActivos)
        <x-empty-state
            title="¡Todo listo para empezar!"
            description="Aún no tienes tareas registradas. Crea tu primera tarea para organizar tu día con fluidez."
            actionText="Crear mi primera tarea"
            :actionHref="route('task.create')"
        />
    @else
        <!-- Tablero Kanban de 3 Columnas (Apple Fluid Board) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

            <!-- Columna 1: Por hacer -->
            @php
                $tareasPorHacer = $tareasPorEstado->get('por_hacer', collect());
            @endphp
            <div class="flex flex-col gap-3 rounded-3xl bg-black/[0.02] dark:bg-white/[0.03] p-4 border border-black/[0.04] dark:border-white/[0.06]">
                <!-- Cabecera de Columna -->
                <div class="flex items-center justify-between px-1 py-1">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-neutral-400"></span>
                        <h3 class="text-sm font-semibold tracking-tight text-[#1d1d1f] dark:text-white">
                            Por hacer
                        </h3>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-neutral-500/10 text-neutral-600 dark:text-neutral-300">
                            {{ $tareasPorHacer->count() }}
                        </span>
                    </div>
                    <a href="{{ route('task.create') }}?estado=por_hacer"
                       title="Añadir tarea a 'Por hacer'"
                       class="p-1 rounded-full text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200 hover:bg-black/[0.05] dark:hover:bg-white/[0.08] transition-colors apple-press">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <!-- Tarjetas -->
                <div class="flex flex-col gap-3 min-h-[140px]">
                    @forelse ($tareasPorHacer as $task)
                        <x-task-card :task="$task" :estados="$estados" :prioridades="$prioridades" />
                    @empty
                        <x-empty-state
                            compact
                            title="Sin tareas pendientes"
                            description="No hay tareas por hacer en este momento."
                        />
                    @endforelse
                </div>
            </div>

            <!-- Columna 2: En curso -->
            @php
                $tareasEnCurso = $tareasPorEstado->get('en_curso', collect());
            @endphp
            <div class="flex flex-col gap-3 rounded-3xl bg-black/[0.02] dark:bg-white/[0.03] p-4 border border-black/[0.04] dark:border-white/[0.06]">
                <!-- Cabecera de Columna -->
                <div class="flex items-center justify-between px-1 py-1">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#0071e3] animate-pulse"></span>
                        <h3 class="text-sm font-semibold tracking-tight text-[#1d1d1f] dark:text-white">
                            En curso
                        </h3>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-[#0071e3]/10 text-[#0071e3] dark:text-[#47a3ff]">
                            {{ $tareasEnCurso->count() }}
                        </span>
                    </div>
                    <a href="{{ route('task.create') }}?estado=en_curso"
                       title="Añadir tarea a 'En curso'"
                       class="p-1 rounded-full text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200 hover:bg-black/[0.05] dark:hover:bg-white/[0.08] transition-colors apple-press">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <!-- Tarjetas -->
                <div class="flex flex-col gap-3 min-h-[140px]">
                    @forelse ($tareasEnCurso as $task)
                        <x-task-card :task="$task" :estados="$estados" :prioridades="$prioridades" />
                    @empty
                        <x-empty-state
                            compact
                            title="Nada en progreso"
                            description="Inicia alguna tarea desde la columna 'Por hacer'."
                        />
                    @endforelse
                </div>
            </div>

            <!-- Columna 3: Terminado -->
            @php
                $tareasTerminadas = $tareasPorEstado->get('terminado', $tareasPorEstado->get('hecha', collect()));
            @endphp
            <div class="flex flex-col gap-3 rounded-3xl bg-black/[0.02] dark:bg-white/[0.03] p-4 border border-black/[0.04] dark:border-white/[0.06]">
                <!-- Cabecera de Columna -->
                <div class="flex items-center justify-between px-1 py-1">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#34c759]"></span>
                        <h3 class="text-sm font-semibold tracking-tight text-[#1d1d1f] dark:text-white">
                            Terminado
                        </h3>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-[#34c759]/10 text-[#248a3d] dark:text-[#34c759]">
                            {{ $tareasTerminadas->count() }}
                        </span>
                    </div>
                </div>

                <!-- Tarjetas -->
                <div class="flex flex-col gap-3 min-h-[140px]">
                    @forelse ($tareasTerminadas as $task)
                        <x-task-card :task="$task" :estados="$estados" :prioridades="$prioridades" />
                    @empty
                        <x-empty-state
                            compact
                            title="Sin tareas terminadas"
                            description="Las tareas que completes se organizarán aquí."
                        />
                    @endforelse
                </div>
            </div>

        </div>
    @endif

</x-layout>
