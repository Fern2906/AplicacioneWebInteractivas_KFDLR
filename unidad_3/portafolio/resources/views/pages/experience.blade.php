<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Experience')] class extends Component {
    public string $filter = 'all';

    public array $filters = [
        'all' => 'Todo',
        'trabajo' => 'Trabajo',
        'educacion' => 'Educación',
    ];

    public array $items = [
        [
            'id' => 'freelance',
            'type' => 'trabajo',
            'period' => '2025 — Actualidad',
            'title' => 'Desarrollador Full Stack Junior',
            'organization' => 'Freelance',
            'description' => 'Desarrollo de sitios y aplicaciones web a medida con Laravel, Livewire y Tailwind CSS, desde el modelado de datos hasta el despliegue.',
            'tags' => ['Laravel', 'Livewire', 'Tailwind CSS'],
        ],
        [
            'id' => 'practicas',
            'type' => 'trabajo',
            'period' => '2025',
            'title' => 'Prácticas de Desarrollo Web',
            'organization' => 'Empresa de desarrollo de software',
            'description' => 'Mantenimiento de módulos internos, corrección de errores y creación de nuevas vistas con Laravel y MySQL.',
            'tags' => ['Laravel', 'MySQL', 'Git'],
        ],
        [
            'id' => 'universidad',
            'type' => 'educacion',
            'period' => '2023 — 2026',
            'title' => 'Desarrollo de Aplicaciones Web',
            'organization' => 'Universidad',
            'description' => 'Formación en desarrollo web, bases de datos, programación orientada a objetos y proyectos de aplicación real.',
            'tags' => ['PHP', 'Bases de datos', 'Ingeniería de software'],
        ],
        [
            'id' => 'curso-livewire',
            'type' => 'educacion',
            'period' => '2025',
            'title' => 'Curso de Laravel y Livewire',
            'organization' => 'Formación online',
            'description' => 'Componentes reactivos, validación, autorización, colas y buenas prácticas del ecosistema Laravel.',
            'tags' => ['Laravel', 'Livewire', 'Testing'],
        ],
        [
            'id' => 'proyectos-academicos',
            'type' => 'trabajo',
            'period' => '2024',
            'title' => 'Desarrollador de Proyectos Académicos',
            'organization' => 'Equipos de trabajo universitarios',
            'description' => 'Colaboración en el diseño y desarrollo de aplicaciones para proyectos de curso, coordinando tareas y revisiones de código.',
            'tags' => ['Trabajo en equipo', 'Git', 'Scrum'],
        ],
        [
            'id' => 'fundamentos',
            'type' => 'educacion',
            'period' => '2022 — 2023',
            'title' => 'Fundamentos de Programación',
            'organization' => 'Formación autodidacta',
            'description' => 'Primeros pasos en lógica de programación, HTML, CSS y JavaScript mediante cursos y proyectos personales.',
            'tags' => ['HTML', 'CSS', 'JavaScript'],
        ],
    ];

    #[Computed]
    public function filteredItems(): array
    {
        if ($this->filter === 'all') {
            return $this->items;
        }

        return array_values(array_filter(
            $this->items,
            fn (array $item) => $item['type'] === $this->filter
        ));
    }
}; ?>

<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Experience</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Experiencia</h1>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            Un recorrido por mi trayectoria profesional y académica.
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
            {{ count($this->filteredItems) }} {{ count($this->filteredItems) === 1 ? 'entrada' : 'entradas' }}
        </p>
    </div>

    <div class="mt-10 max-w-3xl" wire:loading.class="opacity-60">
        @if (count($this->filteredItems) > 0)
            <ol class="relative ms-3 border-s border-gray-200 dark:border-neutral-700">
                @foreach ($this->filteredItems as $item)
                    <livewire:timeline-item :item="$item" wire:key="experience-{{ $item['id'] }}" />
                @endforeach
            </ol>
        @else
            <div class="rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-sm text-gray-500 dark:text-neutral-400">
                    No hay entradas para este filtro.
                </p>
            </div>
        @endif
    </div>

    <section class="mt-16 rounded-2xl border border-gray-200 bg-white p-8 text-center dark:border-neutral-700 dark:bg-neutral-800">
        <h2 class="text-xl font-bold">¿Quieres conocer más?</h2>
        <p class="mx-auto mt-2 max-w-xl text-sm text-gray-600 dark:text-neutral-400">
            Puedes revisar mis proyectos o escribirme directamente para conversar sobre una oportunidad.
        </p>
        <div class="mt-5 flex flex-wrap justify-center gap-3">
            <a href="{{ route('projects') }}" wire:navigate
               class="inline-flex items-center gap-x-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                Ver proyectos
            </a>
            <a href="mailto:correo@ejemplo.com"
               class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-800 shadow-2xs transition-colors hover:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700">
                Contactarme
            </a>
        </div>
    </section>
</div>
