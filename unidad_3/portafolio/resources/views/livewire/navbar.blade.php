<header
    class="sticky top-0 z-50 w-full border-b border-gray-200 bg-white/90 text-sm backdrop-blur dark:border-neutral-700 dark:bg-neutral-900/90">
    <nav class="mx-auto flex w-full max-w-5xl flex-wrap items-center justify-between px-4 py-3 sm:flex-nowrap"
        aria-label="Main navigation">
        <a href="{{ route('home') }}" wire:navigate
            class="flex items-center gap-2 text-xl font-semibold text-gray-800 dark:text-white">
            <span
                class="flex size-9 items-center justify-center rounded-lg bg-blue-600 text-sm font-bold text-white">KF</span>
            <span>Portfolio</span>
        </a>

        <button type="button"
            class="hs-collapse-toggle flex size-9 items-center justify-center rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 sm:hidden dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700"
            data-hs-collapse="#portfolio-navbar" aria-controls="portfolio-navbar" aria-label="Abrir menú de navegación"
            aria-expanded="false">
            <svg class="hs-collapse-open:hidden size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg class="hs-collapse-open:block hidden size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <div id="portfolio-navbar"
            class="hs-collapse hidden w-full overflow-hidden transition-[height] duration-300 sm:block sm:w-auto">
            <div class="mt-2 flex flex-col gap-1 pb-4 sm:mt-0 sm:flex-row sm:items-center sm:gap-1 sm:pb-0">
                @foreach ($navItems as $link)
                    <livewire:tab :label="$link['label']" :url="$link['url']" />
                @endforeach
            </div>
        </div>
    </nav>
</header>
