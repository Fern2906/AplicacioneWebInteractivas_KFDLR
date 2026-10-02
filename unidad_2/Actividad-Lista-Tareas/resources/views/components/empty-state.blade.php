@props([
    'title' => 'Sin tareas',
    'description' => 'No hay tareas en este estado actualmente.',
    'actionText' => null,
    'actionHref' => null,
    'compact' => false,
])

<div class="flex flex-col items-center justify-center text-center {{ $compact ? 'py-8 px-4' : 'py-16 px-6' }} rounded-2xl border border-dashed border-black/[0.08] dark:border-white/[0.08] bg-black/[0.01] dark:bg-white/[0.02]">
    <div class="w-12 h-12 rounded-2xl bg-black/[0.03] dark:bg-white/[0.06] flex items-center justify-center text-neutral-400 dark:text-neutral-500 mb-3 shadow-inner">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
            <path d="m9 14 2 2 4-4"/>
        </svg>
    </div>

    <h4 class="text-sm font-semibold tracking-tight text-[#1d1d1f] dark:text-white mb-1">
        {{ $title }}
    </h4>
    <p class="text-xs text-neutral-500 dark:text-neutral-400 max-w-xs leading-relaxed mb-4">
        {{ $description }}
    </p>

    @if ($actionText && $actionHref)
        <x-button :href="$actionHref" variant="secondary" size="sm">
            <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span>{{ $actionText }}</span>
        </x-button>
    @endif
</div>
