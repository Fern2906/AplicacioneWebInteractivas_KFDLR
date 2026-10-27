<section class="pb-20">
    <div class="rounded-2xl bg-gray-900 px-6 py-12 text-center dark:bg-neutral-800">
        <h2 class="text-2xl font-bold text-white sm:text-3xl">{{ $title }}</h2>
        <p class="mx-auto mt-3 max-w-xl text-gray-300">
            {{ $description }}
        </p>

        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            @if ($secondaryButtonText && $secondaryButtonUrl)
                <a href="{{ $secondaryButtonUrl }}" wire:navigate
                   class="inline-flex items-center gap-x-2 rounded-lg border border-gray-700 bg-neutral-800 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-neutral-700 focus:outline-hidden focus:bg-neutral-700">
                    {{ $secondaryButtonText }}
                </a>
            @endif

            <a href="{{ $buttonUrl }}"
               class="inline-flex items-center gap-x-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                {{ $buttonText }}
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
