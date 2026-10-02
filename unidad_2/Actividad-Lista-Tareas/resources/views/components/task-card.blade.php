@props([
    'task',
    'estados' => [],
    'prioridades' => [],
])

@php
    $isOverdue = false;
    $isDueToday = false;
    $dueFormatted = null;

    if ($task->vencimiento) {
        $dueDate = \Carbon\Carbon::parse($task->vencimiento)->startOfDay();
        $today = \Carbon\Carbon::today();

        $dueFormatted = $dueDate->translatedFormat('d M, Y');
        $isOverdue = $dueDate->isPast() && !$dueDate->isToday() && $task->estado !== 'terminado' && $task->estado !== 'hecha';
        $isDueToday = $dueDate->isToday();
    }
@endphp

<div class="group relative rounded-2xl apple-glass-card border border-black/[0.06] dark:border-white/[0.08] p-4 shadow-[0_2px_12px_-2px_rgba(0,0,0,0.04)] dark:shadow-[0_4px_16px_-4px_rgba(0,0,0,0.3)] hover:shadow-[0_8px_24px_-4px_rgba(0,0,0,0.08)] dark:hover:shadow-[0_8px_24px_-4px_rgba(0,0,0,0.5)] transition-all duration-200 ease-apple hover:-translate-y-0.5">

    <!-- Fila Superior: Badges y Acciones Rápidas -->
    <div class="flex items-center justify-between gap-2 mb-2.5">
        <div class="flex items-center gap-1.5 flex-wrap">
            <x-badge type="prioridad" :value="$task->prioridad" />
            @if ($dueFormatted)
                <span class="inline-flex items-center gap-1 text-[11px] px-2 py-0.5 rounded-full font-medium border
                    {{ $isOverdue
                        ? 'bg-[#ff3b30]/10 text-[#d70015] dark:text-[#ff453a] border-[#ff3b30]/20 font-semibold'
                        : ($isDueToday
                            ? 'bg-[#ff9500]/10 text-[#b25000] dark:text-[#ff9f0a] border-[#ff9500]/20'
                            : 'bg-black/[0.03] dark:bg-white/[0.05] text-neutral-500 dark:text-neutral-400 border-black/[0.04] dark:border-white/[0.06]') }}">
                    <svg class="w-3 h-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    <span>{{ $dueFormatted }}</span>
                </span>
            @endif
        </div>

        <!-- Menú de Acciones (Ver, Editar, Eliminar) -->
        <div class="flex items-center gap-1 opacity-75 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('task.show', $task) }}"
               title="Ver detalle"
               class="p-1 rounded-lg text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200 hover:bg-black/[0.05] dark:hover:bg-white/[0.08] transition-colors apple-press">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </a>
            <a href="{{ route('task.edit', $task) }}"
               title="Editar tarea"
               class="p-1 rounded-lg text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200 hover:bg-black/[0.05] dark:hover:bg-white/[0.08] transition-colors apple-press">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                    <path d="m15 5 4 4"/>
                </svg>
            </a>
            <form action="{{ route('task.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea permanentemente?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        title="Eliminar tarea"
                        class="p-1 rounded-lg text-neutral-400 hover:text-[#ff3b30] hover:bg-[#ff3b30]/10 transition-colors apple-press">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18"/>
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Título y Descripción -->
    <a href="{{ route('task.show', $task) }}" class="block group/link">
        <h4 class="text-sm font-semibold tracking-tight text-[#1d1d1f] dark:text-white group-hover/link:text-[#0071e3] dark:group-hover/link:text-[#47a3ff] transition-colors leading-snug line-clamp-2">
            {{ $task->titulo }}
        </h4>
        @if ($task->descripcion)
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1 line-clamp-2 leading-relaxed">
                {{ $task->descripcion }}
            </p>
        @endif
    </a>

    <!-- Acciones Rápidas de Cambio de Estado en 1 Clic (Direct Manipulation) -->
    <div class="mt-3.5 pt-3 border-t border-black/[0.04] dark:border-white/[0.06] flex items-center justify-between text-xs">
        @if ($task->estado === 'por_hacer')
            <span class="text-[11px] text-neutral-400">Por iniciar</span>
            <form action="{{ route('task.change-status', $task) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="estado" value="en_curso">
                <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#0071e3]/10 hover:bg-[#0071e3]/20 text-[#0071e3] dark:text-[#47a3ff] transition-all apple-press">
                    <span>Iniciar</span>
                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        @elseif ($task->estado === 'en_curso')
            <form action="{{ route('task.change-status', $task) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="estado" value="por_hacer">
                <button type="submit" class="inline-flex items-center gap-1 text-[11px] text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors apple-press">
                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Regresar</span>
                </button>
            </form>
            <form action="{{ route('task.change-status', $task) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="estado" value="terminado">
                <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#34c759]/10 hover:bg-[#34c759]/20 text-[#248a3d] dark:text-[#34c759] transition-all apple-press">
                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Terminar</span>
                </button>
            </form>
        @else
            <span class="text-[11px] text-[#34c759] font-medium flex items-center gap-1">
                <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Completada
            </span>
            <form action="{{ route('task.change-status', $task) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="estado" value="en_curso">
                <button type="submit" class="inline-flex items-center gap-1 text-[11px] text-neutral-400 hover:text-[#0071e3] dark:hover:text-[#47a3ff] transition-colors apple-press">
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5"/>
                    </svg>
                    <span>Reabrir</span>
                </button>
            </form>
        @endif
    </div>
</div>
