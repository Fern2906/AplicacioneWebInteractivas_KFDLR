<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Home')] class extends Component {
    //
}; ?>

<div class="mx-auto w-full max-w-5xl px-4 py-20">
    <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Portafolio</p>

    <h1 class="mt-4 text-4xl font-bold tracking-tight sm:text-5xl">
        Hola, soy KFDLR
    </h1>

    <p class="mt-6 max-w-2xl text-lg text-gray-600 dark:text-neutral-400">
        Desarrollador web. Aquí encontrarás los proyectos que he construido y el recorrido de mi experiencia profesional.
    </p>

    <div class="mt-8 flex flex-wrap gap-3">
        <a href="{{ route('projects') }}" wire:navigate
           class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700">
            Ver proyectos
        </a>
        <a href="{{ route('experience') }}" wire:navigate
           class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">
            Mi experiencia
        </a>
    </div>
</div>
