<footer class="mt-auto w-full border-t border-gray-200 bg-white dark:border-neutral-700 dark:bg-neutral-900" aria-labelledby="portfolio-footer-heading">
    <h2 id="portfolio-footer-heading" class="sr-only">Footer</h2>

    <div class="mx-auto w-full max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:grid-cols-4">
            <div class="col-span-full lg:col-span-2">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2 text-xl font-semibold text-gray-800 dark:text-white">
                    <span class="flex size-9 items-center justify-center rounded-lg bg-blue-600 text-sm font-bold text-white">KF</span>
                    <span>Portafolio</span>
                </a>

                <p class="mt-4 max-w-xs text-sm text-gray-600 dark:text-neutral-400">
                    Portafolio personal: proyectos y experiencia en desarrollo de aplicaciones web.
                </p>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-200">
                    Navegación
                </h3>

                <ul class="mt-4 space-y-2.5">
                    <li>
                        <a href="{{ route('home') }}" wire:navigate
                           class="text-sm text-gray-600 transition-colors hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-500">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects') }}" wire:navigate
                           class="text-sm text-gray-600 transition-colors hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-500">
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('experience') }}" wire:navigate
                           class="text-sm text-gray-600 transition-colors hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-500">
                            Experience
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-200">
                    Contacto
                </h3>

                <ul class="mt-4 space-y-2.5">
                    <li>
                        <a href="https://github.com/" target="_blank" rel="noopener noreferrer"
                           class="text-sm text-gray-600 transition-colors hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-500">
                            GitHub
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                           class="text-sm text-gray-600 transition-colors hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-500">
                            LinkedIn
                        </a>
                    </li>
                    <li>
                        <a href="mailto:correo@ejemplo.com"
                           class="text-sm text-gray-600 transition-colors hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-500">
                            correo@ejemplo.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-col items-center justify-between gap-3 border-t border-gray-200 pt-6 sm:flex-row dark:border-neutral-700">
            <p class="text-sm text-gray-600 dark:text-neutral-400">
                © {{ date('Y') }} KFDLR. Todos los derechos reservados.
            </p>

            <p class="text-sm text-gray-500 dark:text-neutral-500">
                Hecho con Laravel, Livewire y Preline UI
            </p>
        </div>
    </div>
</footer>
