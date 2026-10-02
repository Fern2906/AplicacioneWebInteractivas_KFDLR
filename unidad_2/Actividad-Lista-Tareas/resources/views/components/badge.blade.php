@props([
    'type' => 'estado', // 'estado' o 'prioridad'
    'value' => '',
    'label' => null,
])

@php
    $displayLabel = $label;
    $badgeClasses = '';
    $dotClasses = '';
    $icon = null;

    if ($type === 'estado') {
        switch ($value) {
            case 'en_curso':
                $displayLabel = $displayLabel ?? 'En curso';
                $badgeClasses = 'bg-[#0071e3]/10 dark:bg-[#0071e3]/20 text-[#0071e3] dark:text-[#47a3ff] border-[#0071e3]/20';
                $dotClasses = 'bg-[#0071e3] animate-pulse';
                $icon = 'spinner';
                break;
            case 'terminado':
            case 'hecha':
                $displayLabel = $displayLabel ?? 'Terminado';
                $badgeClasses = 'bg-[#34c759]/10 dark:bg-[#34c759]/20 text-[#248a3d] dark:text-[#34c759] border-[#34c759]/25';
                $dotClasses = 'bg-[#34c759]';
                $icon = 'check';
                break;
            case 'por_hacer':
            default:
                $displayLabel = $displayLabel ?? 'Por hacer';
                $badgeClasses = 'bg-neutral-500/10 dark:bg-neutral-400/15 text-neutral-600 dark:text-neutral-300 border-neutral-400/20';
                $dotClasses = 'bg-neutral-400';
                $icon = 'circle';
                break;
        }
    } elseif ($type === 'prioridad') {
        switch ($value) {
            case 'alta':
                $displayLabel = $displayLabel ?? 'Alta';
                $badgeClasses = 'bg-[#ff3b30]/10 dark:bg-[#ff3b30]/20 text-[#d70015] dark:text-[#ff453a] border-[#ff3b30]/25';
                $dotClasses = 'bg-[#ff3b30]';
                $icon = 'high';
                break;
            case 'media':
                $displayLabel = $displayLabel ?? 'Media';
                $badgeClasses = 'bg-[#ff9500]/10 dark:bg-[#ff9500]/20 text-[#b25000] dark:text-[#ff9f0a] border-[#ff9500]/25';
                $dotClasses = 'bg-[#ff9500]';
                $icon = 'medium';
                break;
            case 'baja':
            default:
                $displayLabel = $displayLabel ?? 'Baja';
                $badgeClasses = 'bg-sky-500/10 dark:bg-sky-500/20 text-sky-700 dark:text-sky-300 border-sky-500/25';
                $dotClasses = 'bg-sky-500';
                $icon = 'low';
                break;
        }
    }
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border {$badgeClasses} transition-colors tracking-tight"]) }}>
    <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $dotClasses }}"></span>
    <span>{{ $displayLabel }}</span>
</span>
