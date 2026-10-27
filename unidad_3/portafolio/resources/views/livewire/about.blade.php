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

            <div class="mt-8">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400">Tecnologías y Herramientas</h3>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($skills as $skill)
                        <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-700 shadow-2xs dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>

            @if (!empty($softSkills))
                <div class="mt-6">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400">Habilidades</h3>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($softSkills as $softSkill)
                            <span class="rounded-full border border-blue-100 bg-blue-50/60 px-3 py-1 text-xs font-medium text-blue-700 dark:border-blue-500/20 dark:bg-blue-500/10 dark:text-blue-400">
                                {{ $softSkill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (!empty($languages))
                <div class="mt-6">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400">Idiomas</h3>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($languages as $lang)
                            <span class="inline-flex items-center gap-x-1.5 rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
                                <span class="size-1.5 rounded-full bg-blue-600 dark:bg-blue-400"></span>
                                {{ $lang }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
