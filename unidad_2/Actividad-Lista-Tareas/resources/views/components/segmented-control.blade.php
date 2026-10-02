@props([
    'name' => '',
    'label' => null,
    'options' => [],
    'value' => null,
    'required' => false,
    'type' => null, // 'estado', 'prioridad', or null
])

@php
    $selectedValue = old($name, $value);
    $hasError = $name && $errors->has($name);
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label class="block text-xs font-semibold tracking-tight text-neutral-600 dark:text-neutral-300">
            {{ $label }}
            @if ($required)
                <span class="text-[#ff3b30]">*</span>
            @endif
        </label>
    @endif

    <div class="p-1 rounded-2xl bg-black/[0.04] dark:bg-white/[0.06] border border-black/[0.04] dark:border-white/[0.06] flex flex-wrap sm:flex-nowrap gap-1">
        @foreach ($options as $optionKey => $optionLabel)
            @php
                $isSelected = (string)$selectedValue === (string)$optionKey;
                $optionId = "{$name}_{$optionKey}";

                // Dot accent for state / priority
                $dotClass = '';
                if ($type === 'estado') {
                    if ($optionKey === 'en_curso') $dotClass = 'bg-[#0071e3]';
                    elseif ($optionKey === 'terminado' || $optionKey === 'hecha') $dotClass = 'bg-[#34c759]';
                    else $dotClass = 'bg-neutral-400';
                } elseif ($type === 'prioridad') {
                    if ($optionKey === 'alta') $dotClass = 'bg-[#ff3b30]';
                    elseif ($optionKey === 'media') $dotClass = 'bg-[#ff9500]';
                    else $dotClass = 'bg-sky-500';
                }
            @endphp
            <label for="{{ $optionId }}"
                   class="flex-1 min-w-[90px] flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl text-xs sm:text-sm font-medium cursor-pointer transition-all duration-150 ease-apple apple-press select-none text-center
                          {{ $isSelected
                             ? 'bg-white dark:bg-[#2c2c2e] text-[#1d1d1f] dark:text-white shadow-sm border border-black/[0.04] dark:border-white/[0.08] font-semibold'
                             : 'text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white hover:bg-black/[0.02] dark:hover:bg-white/[0.02]' }}">
                <input type="radio"
                       id="{{ $optionId }}"
                       name="{{ $name }}"
                       value="{{ $optionKey }}"
                       {{ $isSelected ? 'checked' : '' }}
                       class="sr-only"
                       onchange="this.form ? null : null; document.querySelectorAll('input[name=\'{{ $name }}\']').forEach(r => r.closest('label').classList.remove('bg-white', 'dark:bg-[#2c2c2e]', 'text-[#1d1d1f]', 'dark:text-white', 'shadow-sm', 'font-semibold', 'border', 'border-black/[0.04]', 'dark:border-white/[0.08]')); this.closest('label').classList.add('bg-white', 'dark:bg-[#2c2c2e]', 'text-[#1d1d1f]', 'dark:text-white', 'shadow-sm', 'font-semibold', 'border', 'border-black/[0.04]', 'dark:border-white/[0.08]');">
                @if ($dotClass)
                    <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }} shrink-0"></span>
                @endif
                <span>{{ $optionLabel }}</span>
            </label>
        @endforeach
    </div>

    @if ($hasError)
        <p class="text-xs text-[#ff3b30] flex items-center gap-1 mt-1">
            <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span>{{ $errors->first($name) }}</span>
        </p>
    @endif
</div>
