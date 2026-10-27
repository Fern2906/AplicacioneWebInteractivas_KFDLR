<section class="border-t border-gray-200 py-16 dark:border-neutral-700">
    <div class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">{{ $sectionBadge }}</p>
        <h2 class="mt-3 text-3xl font-bold tracking-tight">{{ $title }}</h2>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            {{ $description }}
        </p>
    </div>

    <div class="mt-10 grid gap-6 md:grid-cols-3">
        @foreach ($services as $service)
            <article class="flex flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-2xs dark:border-neutral-700 dark:bg-neutral-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    @if (($service['icon'] ?? '') === 'code')
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                        </svg>
                    @elseif (($service['icon'] ?? '') === 'sparkles')
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 1-3.42-3.42" />
                        </svg>
                    @else
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                    @endif
                </span>

                <h3 class="mt-4 text-base font-semibold text-gray-800 dark:text-white">
                    {{ $service['title'] }}
                </h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    {{ $service['description'] }}
                </p>
            </article>
        @endforeach
    </div>
</section>
