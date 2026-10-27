<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Projects')] class extends Component {
    public string $filter = 'all';

    public array $filters = [
        'all' => 'Todos',
        'web' => 'Web',
        'academico' => 'Académico',
        'personal' => 'Personal',
    ];

    public array $projects = [
        [
            'id' => 'gestion-academica',
            'title' => 'Sistema de Gestión Académica',
            'description' => 'Plataforma para administrar cursos, estudiantes y calificaciones, con paneles por rol y reportes.',
            'tech' => ['Laravel', 'Livewire', 'MySQL'],
            'category' => 'academico',
            'year' => '2026',
            'repo' => 'https://github.com/',
            'demo' => '',
        ],
        [
            'id' => 'portafolio',
            'title' => 'Portafolio Personal',
            'description' => 'Sitio con páginas de inicio, proyectos y experiencia, construido con componentes Livewire reutilizables.',
            'tech' => ['Laravel', 'Livewire', 'Tailwind CSS', 'Preline UI'],
            'category' => 'web',
            'year' => '2026',
            'repo' => 'https://github.com/',
            'demo' => '',
        ],
        [
            'id' => 'api-tareas',
            'title' => 'API de Tareas',
            'description' => 'API REST para gestionar proyectos y tareas, con autenticación por tokens, validación y pruebas automatizadas.',
            'tech' => ['Laravel', 'REST', 'MySQL', 'PHPUnit'],
            'category' => 'personal',
            'year' => '2025',
            'repo' => 'https://github.com/',
            'demo' => '',
        ],
        [
            'id' => 'landing-cafeteria',
            'title' => 'Landing para Cafetería',
            'description' => 'Página promocional responsive con menú, galería y formulario de contacto.',
            'tech' => ['HTML', 'Tailwind CSS', 'JavaScript'],
            'category' => 'web',
            'year' => '2025',
            'repo' => 'https://github.com/',
            'demo' => '',
        ],
        [
            'id' => 'finanzas',
            'title' => 'App de Finanzas Personales',
            'description' => 'Registro de ingresos y gastos con resumen mensual, categorías y visualización de datos.',
            'tech' => ['Livewire', 'Alpine.js', 'SQLite'],
            'category' => 'academico',
            'year' => '2025',
            'repo' => 'https://github.com/',
            'demo' => '',
        ],
        [
            'id' => 'blog',
            'title' => 'Blog con Panel de Administración',
            'description' => 'Blog con publicación de artículos, categorías, imágenes y un panel privado para administrar el contenido.',
            'tech' => ['Laravel', 'Blade', 'MySQL'],
            'category' => 'personal',
            'year' => '2024',
            'repo' => 'https://github.com/',
            'demo' => '',
        ],
    ];

    #[Computed]
    public function filteredProjects(): array
    {
        if ($this->filter === 'all') {
            return $this->projects;
        }

        return array_values(array_filter(
            $this->projects,
            fn (array $project) => $project['category'] === $this->filter
        ));
    }
}; ?>

<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Projects</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Proyectos</h1>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            Una selección de los proyectos en los que he trabajado. Filtra por tipo para explorar.
        </p>
    </header>

    <div class="mt-8 flex flex-wrap items-center gap-3">
        <div class="inline-flex flex-wrap gap-1 rounded-lg border border-gray-200 bg-white p-1 shadow-2xs dark:border-neutral-700 dark:bg-neutral-800">
            @foreach ($filters as $key => $label)
                <button
                    type="button"
                    wire:click="$set('filter', '{{ $key }}')"
                    @if ($filter === $key) aria-pressed="true" @else aria-pressed="false" @endif
                    class="rounded-md px-3 py-1.5 text-sm font-medium transition-colors {{ $filter === $key
                        ? 'bg-blue-600 text-white'
                        : 'text-gray-600 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <p class="text-sm text-gray-500 dark:text-neutral-400">
            {{ count($this->filteredProjects) }} {{ count($this->filteredProjects) === 1 ? 'proyecto' : 'proyectos' }}
        </p>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3" wire:loading.class="opacity-60">
        @forelse ($this->filteredProjects as $project)
            <livewire:project-card :project="$project" wire:key="project-{{ $project['id'] }}" />
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-sm text-gray-500 dark:text-neutral-400">
                    No hay proyectos en esta categoría todavía.
                </p>
            </div>
        @endforelse
    </div>
</div>
