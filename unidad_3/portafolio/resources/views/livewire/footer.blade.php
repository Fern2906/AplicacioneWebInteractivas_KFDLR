<footer class="mt-auto w-full border-t border-gray-200 bg-white dark:border-neutral-700 dark:bg-neutral-900"
    aria-labelledby="portfolio-footer-heading">
    <h2 id="portfolio-footer-heading" class="sr-only">Footer</h2>

    <div class="mx-auto w-full max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:grid-cols-4">
            <div class="col-span-full lg:col-span-2">
                <a href="{{ route('home') }}" wire:navigate
                    class="flex items-center gap-2 text-xl font-semibold text-gray-800 dark:text-white">
                    <span
                        class="flex size-9 items-center justify-center rounded-lg bg-blue-600 text-sm font-bold text-white">KF</span>
                    <span>Portfolio</span>
                </a>

                <p class="mt-4 max-w-xs text-sm text-gray-600 dark:text-neutral-400">
                    Kevin Fernando De León Ramírez — Estudiante de Ingeniería en Sistemas Inteligentes y Desarrollador Full-Stack (San Luis Potosí, MX).
                </p>
            </div>

            @foreach ($sections as $section)
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-200">
                        {{ $section['name'] }}
                    </h3>
                    <ul class="mt-4 space-y-2.5">
                        @foreach ($section['links'] as $link)
                            <li>
                                <livewire:link :url="$link['url']" :label="$link['label']" :key="$link['url']" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="mt-8 border-t border-gray-200 pt-8 dark:border-neutral-700">
            <div class="flex flex-col items-center justify-between gap-y-4 sm:flex-row sm:gap-y-0">
                <p class="text-sm text-gray-500 dark:text-neutral-400">
                    © {{ $year }} Kevin Fernando De León Ramírez. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
