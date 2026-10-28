<section class="grid items-center gap-12 py-16 lg:py-24">
    <div>
        <span class="inline-flex items-center gap-x-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
            <span class="size-1.5 rounded-full bg-blue-600 dark:bg-blue-500"></span>
            {{ $status }}
        </span>

        <h1 class="mt-5 text-4xl font-bold tracking-tight sm:text-5xl">
            {{ $greeting }} <span class="text-blue-600 dark:text-blue-500">{{ $name }}</span>
        </h1>

        <p class="mt-2 text-2xl font-semibold text-gray-700 dark:text-neutral-300">
            {{ $role }}
        </p>

        <p class="mt-6 text-lg text-gray-600 dark:text-neutral-400">
            {{ $description }}
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('projects') }}" wire:navigate
               class="inline-flex items-center gap-x-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                View Projects
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>

            <a href="{{ route('experience') }}" wire:navigate
               class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-800 shadow-2xs transition-colors hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                My Experience
            </a>
        </div>

        <div class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-gray-500 dark:text-neutral-400">
            @foreach ($techBadges as $badge)
                <span class="inline-flex items-center gap-x-2">
                    <svg class="size-4 shrink-0 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    {{ $badge }}
                </span>
            @endforeach
        </div>
    </div>
</section>