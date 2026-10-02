@props([
    'label' => null,
    'name' => '',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'placeholder' => '',
    'hint' => null,
])

@php
    $hasError = $name && $errors->has($name);
    $inputValue = old($name, $value);
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $name }}" class="block text-xs font-semibold tracking-tight text-neutral-600 dark:text-neutral-300">
            {{ $label }}
            @if ($required)
                <span class="text-[#ff3b30]">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $name }}"
               value="{{ $inputValue }}"
               placeholder="{{ $placeholder }}"
               {{ $required ? 'required' : '' }}
               {{ $attributes->merge([
                   'class' => 'w-full px-3.5 py-2.5 rounded-xl text-sm transition-all duration-150 ease-apple ' .
                              'bg-black/[0.03] dark:bg-white/[0.06] text-[#1d1d1f] dark:text-white ' .
                              'border ' . ($hasError ? 'border-[#ff3b30] focus:ring-[#ff3b30]/30 focus:border-[#ff3b30]' : 'border-black/10 dark:border-white/10 focus:ring-[#0071e3]/30 focus:border-[#0071e3]') . ' ' .
                              'focus:outline-none focus:ring-2 focus:bg-white dark:focus:bg-[#1c1c1e] ' .
                              'placeholder:text-neutral-400 dark:placeholder:text-neutral-500'
               ]) }}>
    </div>

    @if ($hint && !$hasError)
        <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $hint }}</p>
    @endif

    @if ($hasError)
        <p class="text-xs text-[#ff3b30] flex items-center gap-1 mt-1">
            <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span>{{ $errors->first($name) }}</span>
        </p>
    @endif
</div>
