@props(['title' => 'Tareas'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title }} — {{ config('app.name', 'Tareas') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script de inicialización de tema claro/oscuro antes de pintar (sin parpadeos) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="h-full bg-[#f5f5f7] dark:bg-[#000000] text-[#1d1d1f] dark:text-[#f5f5f7] font-sans antialiased selection:bg-[#0071e3]/20 selection:text-[#0071e3] flex flex-col">

    <!-- Notificación Flotante tipo Dynamic Island / Cápsula Apple -->
    @if (session('exito'))
        <div id="apple-toast"
             role="status"
             aria-live="polite"
             class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 px-4 py-2.5 rounded-full apple-glass border border-black/[0.08] dark:border-white/[0.12] shadow-[0_12px_32px_rgba(0,0,0,0.12)] dark:shadow-[0_12px_32px_rgba(0,0,0,0.5)] text-sm font-medium transition-all duration-300 ease-apple animate-bounce-subtle">
            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#34c759] text-white shrink-0">
                <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
            <span class="text-[#1d1d1f] dark:text-white">{{ session('exito') }}</span>
            <button type="button" onclick="dismissToast()" class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 transition-colors p-0.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <script>
            function dismissToast() {
                const toast = document.getElementById('apple-toast');
                if (toast) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translate(-50%, -10px) scale(0.95)';
                    setTimeout(() => toast.remove(), 250);
                }
            }
            setTimeout(dismissToast, 3800);
        </script>
    @endif

    <!-- Barra de Navegación Translúcida Superior (Apple Chrome) -->
    <header class="sticky top-0 z-30 apple-glass border-b border-black/[0.06] dark:border-white/[0.08] transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
            <!-- Marca / Título -->
            <a href="{{ route('task.index') }}" class="flex items-center gap-2.5 text-base font-semibold tracking-tight text-[#1d1d1f] dark:text-white apple-press">
                <div class="w-8 h-8 rounded-[9px] bg-gradient-to-tr from-[#0071e3] to-[#47a3ff] flex items-center justify-center text-white shadow-sm shadow-[#0071e3]/30">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" class="hidden"/>
                        <path d="m9 12 2 2 4-4"/>
                        <rect width="18" height="18" x="3" y="3" rx="5"/>
                    </svg>
                </div>
                <span>Tareas</span>
            </a>

            <!-- Acciones de Navegación -->
            <div class="flex items-center gap-2">
                <a href="{{ route('task.index') }}"
                   class="px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-all apple-press {{ request()->routeIs('task.index') ? 'bg-black/5 dark:bg-white/10 text-[#0071e3] dark:text-[#47a3ff]' : 'text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white' }}">
                    Tablero
                </a>

                <a href="{{ route('task.create') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium bg-[#0071e3] hover:bg-[#0077ed] text-white shadow-sm shadow-[#0071e3]/20 transition-all apple-press">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Nueva tarea</span>
                </a>

                <!-- Alternador de Modo Claro / Oscuro -->
                <button type="button"
                        onclick="toggleDarkMode()"
                        aria-label="Alternar tema claro y oscuro"
                        class="p-2 rounded-full text-neutral-500 hover:text-neutral-800 dark:text-neutral-400 dark:hover:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-colors apple-press">
                    <!-- Icono Sol (se muestra en modo oscuro) -->
                    <svg class="w-4 h-4 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"/>
                        <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                    </svg>
                    <!-- Icono Luna (se muestra en modo claro) -->
                    <svg class="w-4 h-4 block dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        {{ $slot }}
    </main>

    <!-- Pie de página discreto -->
    <footer class="border-t border-black/[0.04] dark:border-white/[0.04] py-6 text-center text-xs text-neutral-400 dark:text-neutral-500">
        <p>Diseño fluido e intuitivo inspirado en Apple Design Guidelines &copy; {{ date('Y') }}</p>
    </footer>

    <!-- Script de alternancia de tema -->
    <script>
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>
</body>
</html>
