<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Projects')] class extends Component {
}; ?>

<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header>
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Projects</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Proyectos</h1>
        <p class="mt-3 max-w-2xl text-gray-600 dark:text-neutral-400">
            Una selección de los proyectos en los que he trabajado.
        </p>
    </header>

    <div class="mt-10 rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center dark:border-neutral-700 dark:bg-neutral-800">
        <p class="text-sm text-gray-500 dark:text-neutral-400">Próximamente: listado de proyectos.</p>
    </div>
</div>
