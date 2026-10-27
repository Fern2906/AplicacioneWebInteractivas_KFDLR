<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Home')] class extends Component {
    //
}; ?>

<div class="mx-auto w-full max-w-5xl px-4">

    {{-- Hero --}}
    <section class="grid items-center gap-12 py-16 lg:grid-cols-2 lg:py-24">
        <div>
            <span class="inline-flex items-center gap-x-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                <span class="size-1.5 rounded-full bg-blue-600 dark:bg-blue-500"></span>
                Disponible para proyectos
            </span>

            <h1 class="mt-5 text-4xl font-bold tracking-tight sm:text-5xl">
                Hola, soy <span class="text-blue-600 dark:text-blue-500">KFDLR</span>
            </h1>

            <p class="mt-2 text-2xl font-semibold text-gray-700 dark:text-neutral-300">
                Desarrollador Web Full Stack
            </p>

            <p class="mt-6 max-w-xl text-lg text-gray-600 dark:text-neutral-400">
                Construyo aplicaciones web claras, rápidas y mantenibles. Trabajo principalmente con
                Laravel, Livewire y Tailwind CSS, cuidando tanto la lógica del backend como la experiencia de usuario.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('projects') }}" wire:navigate
                   class="inline-flex items-center gap-x-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                    Ver proyectos
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>

                <a href="{{ route('experience') }}" wire:navigate
                   class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-800 shadow-2xs transition-colors hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    Mi experiencia
                </a>
            </div>

            <div class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-gray-500 dark:text-neutral-400">
                <span class="inline-flex items-center gap-x-2">
                    <svg class="size-4 shrink-0 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Laravel + Livewire
                </span>
                <span class="inline-flex items-center gap-x-2">
                    <svg class="size-4 shrink-0 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Tailwind CSS
                </span>
                <span class="inline-flex items-center gap-x-2">
                    <svg class="size-4 shrink-0 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Preline UI
                </span>
            </div>
        </div>

        <div class="relative mx-auto w-full max-w-sm">
            <div class="flex aspect-square w-full items-center justify-center rounded-3xl bg-linear-to-br from-blue-600 to-cyan-500 shadow-xl">
                <span class="text-7xl font-bold text-white">KF</span>
            </div>

            <div class="absolute -bottom-5 left-1/2 w-[85%] -translate-x-1/2 rounded-xl border border-gray-200 bg-white px-4 py-3 text-center shadow-lg dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-sm font-semibold text-gray-800 dark:text-white">Portafolio 2026</p>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">Proyectos y experiencia</p>
            </div>
        </div>
    </section>

    {{-- Sobre mí --}}
    <section class="border-t border-gray-200 py-16 dark:border-neutral-700">
        <div class="grid gap-10 lg:grid-cols-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Sobre mí</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight">Un poco de contexto</h2>
            </div>

            <div class="lg:col-span-2">
                <p class="text-gray-600 dark:text-neutral-400">
                    Soy estudiante de desarrollo de aplicaciones web y me apasiona convertir ideas en productos
                    funcionales. Disfruto especialmente el trabajo con componentes reutilizables, la organización
                    del código y las interfaces simples que se sienten rápidas.
                </p>

                <p class="mt-4 text-gray-600 dark:text-neutral-400">
                    En este portafolio reúno los proyectos que he construido y las experiencias que han marcado
                    mi formación como desarrollador.
                </p>

                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach (['Laravel', 'Livewire', 'PHP', 'Tailwind CSS', 'JavaScript', 'MySQL', 'Git'] as $skill)
                        <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Qué hago --}}
    <section class="border-t border-gray-200 py-16 dark:border-neutral-700">
        <div class="max-w-2xl">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Servicios</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight">En qué puedo ayudarte</h2>
            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Estas son las áreas en las que concentro mi trabajo.
            </p>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
            <article class="flex flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-2xs dark:border-neutral-700 dark:bg-neutral-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                    </svg>
                </span>

                <h3 class="mt-4 text-base font-semibold text-gray-800 dark:text-white">Aplicaciones web</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Desarrollo con Laravel y Livewire: rutas, componentes reactivos, validación y lógica de negocio.
                </p>
            </article>

            <article class="flex flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-2xs dark:border-neutral-700 dark:bg-neutral-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 1-3.42-3.42" />
                    </svg>
                </span>

                <h3 class="mt-4 text-base font-semibold text-gray-800 dark:text-white">Interfaces</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Maquetación responsive con Tailwind CSS y componentes de Preline UI, con atención al detalle.
                </p>
            </article>

            <article class="flex flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-2xs dark:border-neutral-700 dark:bg-neutral-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>
                </span>

                <h3 class="mt-4 text-base font-semibold text-gray-800 dark:text-white">Datos y APIs</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Modelado de bases de datos, consultas con Eloquent y consumo o creación de APIs REST.
                </p>
            </article>
        </div>
    </section>

    {{-- CTA --}}
    <section class="pb-20">
        <div class="rounded-2xl bg-gray-900 px-6 py-12 text-center dark:bg-neutral-800">
            <h2 class="text-2xl font-bold text-white sm:text-3xl">¿Trabajamos juntos?</h2>
            <p class="mx-auto mt-3 max-w-xl text-gray-300">
                Estoy abierto a proyectos, prácticas y colaboraciones. Escríbeme y conversemos.
            </p>

            <a href="mailto:correo@ejemplo.com"
               class="mt-6 inline-flex items-center gap-x-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                Contactarme
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>
</div>
