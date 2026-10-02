@props([
    'as' => 'div',
    'interactive' => false,
])

<{{ $as }} {{ $attributes->merge([
    'class' => 'rounded-2xl sm:rounded-3xl apple-glass-card border border-black/[0.06] dark:border-white/[0.08] shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] dark:shadow-[0_4px_24px_-4px_rgba(0,0,0,0.35)] transition-all duration-200 ' . ($interactive ? 'hover:shadow-[0_8px_30px_-4px_rgba(0,0,0,0.08)] dark:hover:shadow-[0_8px_30px_-4px_rgba(0,0,0,0.5)] hover:-translate-y-0.5 apple-press cursor-pointer' : '')
]) }}>
    {{ $slot }}
</{{ $as }}>
