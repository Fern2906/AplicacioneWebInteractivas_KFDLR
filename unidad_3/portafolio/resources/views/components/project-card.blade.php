<?php

use Livewire\Component;

new class extends Component {
    public array $project = [];
}; ?>

<article class="group flex h-full flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-2xs transition-colors hover:border-blue-300 dark:border-neutral-700 dark:bg-neutral-800 dark:hover:border-blue-500/50">
    <div class="flex items-start justify-between gap-3">
        <span class="flex size-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
            <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
            </svg>
        </span>

        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600 dark:bg-neutral-700 dark:text-neutral-300">
            {{ $project['year'] }}
        </span>
    </div>

    <h3 class="mt-4 text-base font-semibold text-gray-800 dark:text-white">
        {{ $project['title'] }}
    </h3>

    <p class="mt-2 flex-1 text-sm text-gray-600 dark:text-neutral-400">
        {{ $project['description'] }}
    </p>

    <ul class="mt-4 flex flex-wrap gap-1.5">
        @foreach ($project['tech'] as $tech)
            <li class="rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:border-neutral-600 dark:text-neutral-300">
                {{ $tech }}
            </li>
        @endforeach
    </ul>

    <div class="mt-5 flex items-center gap-4 border-t border-gray-100 pt-4 dark:border-neutral-700">
        <a href="{{ $project['repo'] }}" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-x-1.5 text-sm font-medium text-gray-700 transition-colors hover:text-blue-600 dark:text-neutral-300 dark:hover:text-blue-500">
            <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 .5C5.73.5.5 5.73.5 12c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.52-1.33-1.28-1.68-1.28-1.68-1.05-.72.08-.71.08-.71 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.7 1.26 3.36.96.1-.75.4-1.26.73-1.55-2.55-.29-5.24-1.28-5.24-5.68 0-1.26.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11.1 11.1 0 0 1 5.79 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.83 1.19 3.09 0 4.41-2.69 5.38-5.25 5.67.41.35.78 1.05.78 2.12 0 1.53-.01 2.76-.01 3.14 0 .31.21.67.8.56A11.51 11.51 0 0 0 23.5 12C23.5 5.73 18.27.5 12 .5Z" />
            </svg>
            Código
        </a>

        @if (filled($project['demo'] ?? null))
            <a href="{{ $project['demo'] }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-x-1.5 text-sm font-medium text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400">
                Demo
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
            </a>
        @endif
    </div>
</article>
