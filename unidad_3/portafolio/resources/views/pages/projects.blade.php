<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Projects')] class extends Component {
    public string $filter = 'all';

    public array $filters = [
        'all' => 'All',
        'web' => 'Web',
        'academico' => 'Academic',
        'personal' => 'Personal / Mobile',
    ];

    public array $projects = [
        [
            'id' => 'sistema-cacei',
            'title' => 'CACEI System',
            'description' => 'Web application to automate the calculation of CACEI educational performance indicators (failed courses, dropout, and attrition rates) via file uploads, replacing a manual process. Generates dynamic reports and charts with QuickChart, built under SCRUM methodology.',
            'tech' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Livewire', 'Alpine.js', 'Blade', 'QuickChart'],
            'category' => 'web',
            'year' => '2025',
            'repo' => 'https://github.com/MateoMarroquin/CACEI-Reportes-de-indices-de-rendimiento-escolar.git',
            'demo' => '',
        ],
        [
            'id' => 'daikin-visitor-system',
            'title' => 'Visitor Registration System',
            'description' => 'Enterprise visitor registration and tracking management system designed for host control, visit logistics, lobby check-ins, and vehicle access management.',
            'tech' => ['C#', '.NET', 'ASP.NET Core', 'SQL Server', 'Bootstrap'],
            'category' => 'web',
            'year' => '2025',
            'repo' => '',
            'demo' => '',
        ],
        [
            'id' => 'clasificador-astronomico',
            'title' => 'Astronomical Object Classifier',
            'description' => 'Training of SVM and Random Forest models on the ELAsTiCC dataset to classify variable stars (Cepheid, RR Lyrae, Delta Scuti, Eclipsing Binary).',
            'tech' => ['Python', 'scikit-learn', 'Jupyter', 'Machine Learning', 'Pandas'],
            'category' => 'academico',
            'year' => '2025',
            'repo' => 'https://github.com/Fern2906/ml-astronomical-classification',
            'demo' => '',
        ],
        [
            'id' => 'numi',
            'title' => 'NUMI — Vacation Rentals',
            'description' => 'Mobile vacation rental application built with Flutter featuring local persistence using SQLite. Includes property catalog and listings, search filters, reservation system, and integration of geolocation APIs on an interactive map.',
            'tech' => ['Dart', 'Flutter', 'SQLite', 'Geolocation', 'APIs'],
            'category' => 'personal',
            'year' => '2024',
            'repo' => '',
            'demo' => 'https://youtube.com/shorts/ILPmVhhK3k4?si=257RD3wCrsZ8gz7f',
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
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Projects</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Featured Projects</h1>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            A selection of software engineering projects, applications, and systems I've worked on.
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
            {{ count($this->filteredProjects) }} {{ count($this->filteredProjects) === 1 ? 'project' : 'projects' }}
        </p>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3" wire:loading.class="opacity-60">
        @forelse ($this->filteredProjects as $project)
            <livewire:project-card :project="$project" wire:key="project-{{ $project['id'] }}" />
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-sm text-gray-500 dark:text-neutral-400">
                    No projects found in this category yet.
                </p>
            </div>
        @endforelse
    </div>
</div>