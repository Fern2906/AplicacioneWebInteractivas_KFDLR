<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Proyectos')] class extends Component {
    public string $filter = 'all';

    public array $filters = [
        'all' => 'Todos',
        'web' => 'Web',
        'academico' => 'Académico',
        'personal' => 'Personal / Móvil',
    ];

    public array $projects = [
        [
            'id' => 'sistema-cacei',
            'title' => 'Sistema CACEI',
            'description' => 'Aplicación web para automatizar el cálculo de índices educativos CACEI (reprobación, deserción, abandono) mediante carga de archivos, reemplazando un proceso manual. Generación de reportes y visualizaciones dinámicas con Quick Chart, desarrollada bajo metodología SCRUM con pruebas unitarias y manuales técnico y de usuario.',
            'tech' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Livewire', 'Alpine.js', 'Blade', 'QuickChart'],
            'category' => 'web',
            'year' => '2025',
            'repo' => 'https://github.com/MateoMarroquin/CACEI-Reportes-de-indices-de-rendimiento-escolar.git',
            'demo' => '',
        ],
        [
            'id' => 'clasificador-astronomico',
            'title' => 'Clasificador de Objetos Astronómicos',
            'description' => 'Entrenamiento de modelos SVM y Random Forest sobre 164,152 muestras del dataset ELAsTiCC para clasificar 4 tipos de estrellas variables (Cefeida, RR Lyrae, Delta Scuti, Binaria Eclipsante), con generación de reporte y análisis comparativo de métricas de desempeño.',
            'tech' => ['Python', 'scikit-learn', 'Jupyter', 'Machine Learning', 'Pandas'],
            'category' => 'academico',
            'year' => '2024',
            'repo' => 'https://github.com/Fern2906/ml-astronomical-classification',
            'demo' => '',
        ],
        [
            'id' => 'numi',
            'title' => 'NUMI — Renta Vacacional',
            'description' => 'Aplicación móvil de renta vacacional desarrollada en Flutter con persistencia local en SQLite. Incorpora catálogo y listado de propiedades, filtros de búsqueda, sistema de reservas e integración de APIs de geolocalización e imágenes turísticas en un mapa interactivo.',
            'tech' => ['Dart', 'Flutter', 'SQLite', 'Geolocalización', 'APIs'],
            'category' => 'personal',
            'year' => '2025',
            'repo' => '',
            'demo' => 'https://youtube.com/shorts/ILPmVhhK3k4?si=257RD3wCrsZ8gz7f',
        ],
        [
            'id' => 'portafolio-web',
            'title' => 'Portafolio Web Personal',
            'description' => 'Portafolio reactivo y modular desarrollado con Laravel 11, Livewire 3 y Tailwind CSS, diseñado para exhibir proyectos de software, experiencia profesional y competencias técnicas con diseño moderno y modo oscuro.',
            'tech' => ['Laravel', 'Livewire', 'Tailwind CSS', 'Alpine.js', 'Blade'],
            'category' => 'web',
            'year' => '2026',
            'repo' => 'https://github.com/Fern2906',
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

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }
}; ?>

<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Proyectos</p>
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
                    wire:click="setFilter('{{ $key }}')"
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
