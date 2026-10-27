<?php

use Livewire\Component;

new class extends Component {
    public array $item = [];
}; ?>

<li class="relative mb-10 ms-6 last:mb-0">
    <span class="absolute -start-[1.9rem] top-1 flex size-3.5 items-center justify-center rounded-full bg-blue-600 ring-4 ring-gray-50 dark:bg-blue-500 dark:ring-neutral-900"></span>

    <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
        <span class="rounded-full px-2.5 py-0.5 text-xs font-medium
            @if ($item['type'] === 'trabajo')
                bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400
            @else
                bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400
            @endif">
            {{ $item['type'] === 'trabajo' ? 'Trabajo' : 'Educación' }}
        </span>

        <time class="text-xs font-medium text-gray-500 dark:text-neutral-400">
            {{ $item['period'] }}
        </time>
    </div>

    <h3 class="mt-2 text-base font-semibold text-gray-800 dark:text-white">
        {{ $item['title'] }}
    </h3>

    <p class="text-sm font-medium text-gray-600 dark:text-neutral-300">
        {{ $item['organization'] }}
    </p>

    <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
        {{ $item['description'] }}
    </p>

    @if (filled($item['tags'] ?? null))
        <ul class="mt-3 flex flex-wrap gap-1.5">
            @foreach ($item['tags'] as $tag)
                <li class="rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:border-neutral-600 dark:text-neutral-300">
                    {{ $tag }}
                </li>
            @endforeach
        </ul>
    @endif
</li>
