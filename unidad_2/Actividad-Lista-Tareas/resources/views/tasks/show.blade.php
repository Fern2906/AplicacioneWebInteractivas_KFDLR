<x-layout :title="$tarea->titulo">

    @php
        $dueDate = $tarea->vencimiento ? \Carbon\Carbon::parse($tarea->vencimiento)->startOfDay() : null;
        $isOverdue = $dueDate && $dueDate->isPast() && !$dueDate->isToday() && $tarea->estado !== 'terminado' && $tarea->estado !== 'hecha';
        $isDueToday = $dueDate && $dueDate->isToday();
        $daysDiff = $dueDate ? $dueDate->diffInDays(\Carbon\Carbon::today(), false) : null;
    @endphp

    <div class="max-w-3xl mx-auto">
        <!-- Navegación de Regreso y Acciones Principales -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('task.index') }}"
               class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-neutral-500 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white transition-colors apple-press">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Volver al tablero</span>
            </a>

            <div class="flex items-center gap-2">
                <x-button :href="route('task.edit', $tarea)" variant="secondary" size="sm">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                        <path d="m15 5 4 4"/>
                    </svg>
                    <span>Editar tarea</span>
                </x-button>

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
        </div>

        <!-- Tarjeta Principal de Detalle Apple Display -->
        <x-card class="p-6 sm:p-8 mb-6">
            <!-- Insignias de Estado y Prioridad -->
            <div class="flex items-center gap-2 flex-wrap mb-4">
                <x-badge type="estado" :value="$tarea->estado" />
                <x-badge type="prioridad" :value="$tarea->prioridad" />

                @if ($dueDate)
                    <span class="inline-flex items-center gap-1 text-xs px-2.5 py-0.5 rounded-full font-medium border
                        {{ $isOverdue
                            ? 'bg-[#ff3b30]/10 text-[#d70015] dark:text-[#ff453a] border-[#ff3b30]/20 font-semibold'
                            : ($isDueToday
                                ? 'bg-[#ff9500]/10 text-[#b25000] dark:text-[#ff9f0a] border-[#ff9500]/20'
                                : 'bg-black/[0.03] dark:bg-white/[0.05] text-neutral-600 dark:text-neutral-300 border-black/[0.04] dark:border-white/[0.06]') }}">
                        <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                        <span>Vence: {{ $dueDate->translatedFormat('d \d\e F, Y') }}</span>
                        @if ($isOverdue)
                            <span class="font-bold">({{ abs($daysDiff) }} {{ abs($daysDiff) === 1 ? 'día vencida' : 'días vencida' }})</span>
                        @elseif ($isDueToday)
                            <span class="font-bold">(¡Vence hoy!)</span>
                        @endif
                    </span>
                @endif
            </div>

            <!-- Título Display de Apple -->
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#1d1d1f] dark:text-white leading-snug mb-5">
                {{ $tarea->titulo }}
            </h1>

            <!-- Descripción -->
            <div class="prose prose-neutral dark:prose-invert max-w-none">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-neutral-400 dark:text-neutral-500 mb-2">
                    Descripción
                </h3>
                @if ($tarea->descripcion)
                    <div class="p-4 rounded-2xl bg-black/[0.02] dark:bg-white/[0.03] border border-black/[0.04] dark:border-white/[0.06] text-sm sm:text-base text-neutral-700 dark:text-neutral-300 whitespace-pre-line leading-relaxed">
                        {{ $tarea->descripcion }}
                    </div>
                @else
                    <p class="text-sm italic text-neutral-400 dark:text-neutral-500">
                        Esta tarea no tiene una descripción adicional asignada.
                    </p>
                @endif
            </div>

            <!-- Cambio Rápido de Estado en el Detalle (Direct Manipulation) -->
            <div class="mt-8 pt-6 border-t border-black/[0.04] dark:border-white/[0.06]">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-neutral-400 dark:text-neutral-500 mb-3">
                    Cambiar estado directamente
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($estados as $clave => $etiqueta)
                        <form action="{{ route('task.change-status', $tarea) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="estado" value="{{ $clave }}">
                            <button type="submit"
                                    {{ $tarea->estado === $clave ? 'disabled' : '' }}
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium transition-all apple-press
                                           {{ $tarea->estado === $clave
                                              ? 'bg-[#0071e3] text-white shadow-sm cursor-default'
                                              : 'bg-black/[0.04] dark:bg-white/[0.06] hover:bg-black/[0.08] dark:hover:bg-white/[0.12] text-neutral-600 dark:text-neutral-300' }}">
                                @if ($tarea->estado === $clave)
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                                <span>{{ $etiqueta }}</span>
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        </x-card>

        <!-- Tarjeta de Metadatos Adicionales -->
        <x-card class="p-6">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-neutral-400 dark:text-neutral-500 mb-4">
                Información de auditoría
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-neutral-600 dark:text-neutral-400">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-neutral-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span>Creada el: <strong class="text-neutral-800 dark:text-neutral-200">{{ $tarea->created_at->translatedFormat('d M Y, H:i') }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-neutral-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5"/>
                        <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
                        <path d="M16 21h5v-5"/>
                    </svg>
                    <span>Última actualización: <strong class="text-neutral-800 dark:text-neutral-200">{{ $tarea->updated_at->diffForHumans() }}</strong></span>
                </div>
            </div>
        </x-card>
    </div>

</x-layout>
