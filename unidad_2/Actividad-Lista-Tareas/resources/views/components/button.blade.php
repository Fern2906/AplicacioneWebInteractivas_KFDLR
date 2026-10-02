@props([
    'variant' => 'primary', // 'primary', 'secondary', 'destructive', 'ghost'
    'size' => 'md',        // 'sm', 'md', 'lg'
    'href' => null,
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-full transition-all duration-150 ease-apple apple-press focus:outline-none focus:ring-2 focus:ring-[#0071e3]/40 disabled:opacity-50 disabled:pointer-events-none select-none';

    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs gap-1.5',
        'md' => 'px-4 py-2 text-sm gap-2',
        'lg' => 'px-6 py-3 text-base gap-2.5',
    ][$size] ?? 'px-4 py-2 text-sm gap-2';

    $variantClasses = [
        'primary' => 'bg-[#0071e3] hover:bg-[#0077ed] text-white shadow-sm shadow-[#0071e3]/25 border border-transparent',
        'secondary' => 'bg-black/[0.05] dark:bg-white/[0.08] hover:bg-black/[0.09] dark:hover:bg-white/[0.14] text-[#1d1d1f] dark:text-neutral-200 border border-black/[0.04] dark:border-white/[0.06]',
        'destructive' => 'bg-[#ff3b30]/10 dark:bg-[#ff3b30]/20 hover:bg-[#ff3b30]/20 dark:hover:bg-[#ff3b30]/30 text-[#d70015] dark:text-[#ff453a] border border-[#ff3b30]/25',
        'ghost' => 'bg-transparent hover:bg-black/[0.05] dark:hover:bg-white/[0.08] text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white',
    ][$variant] ?? 'bg-[#0071e3] text-white';

    $classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
