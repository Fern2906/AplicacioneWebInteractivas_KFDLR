<section class="border-t border-gray-200 py-16 dark:border-neutral-700">
    <div class="grid gap-10 lg:grid-cols-3">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">{{ $sectionBadge }}</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight">{{ $title }}</h2>
        </div>

        <div class="lg:col-span-2">
            @foreach ($paragraphs as $paragraph)
                <p class="{{ $loop->first ? '' : 'mt-4 ' }}text-gray-600 dark:text-neutral-400">
                    {{ $paragraph }}
                </p>
            @endforeach

            <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($skills as $skill)
                    <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</section>
