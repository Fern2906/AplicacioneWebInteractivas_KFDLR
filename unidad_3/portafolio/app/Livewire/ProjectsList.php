<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectsList extends Component
{
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
            'description' => 'Web application to automate the calculation of CACEI educational indicators (failed courses, dropout, and attrition rates) via file uploads, replacing a manual process. Generates dynamic reports and visualizations using Quick Chart. Developed under Agile/SCRUM methodology with unit testing, along with complete technical and user documentation.',
            'tech' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Livewire', 'Alpine.js', 'Blade', 'QuickChart'],
            'category' => 'web',
            'year' => '2025',
            'repo' => 'https://github.com/MateoMarroquin/CACEI-Reportes-de-indices-de-rendimiento-escolar.git',
            'demo' => '',
        ],
        [
            'id' => 'clasificador-astronomico',
            'title' => 'Astronomical Object Classifier',
            'description' => 'Training of SVM and Random Forest models on 164,152 samples from the ELAsTiCC dataset to classify 4 types of variable stars (Cepheid, RR Lyrae, Delta Scuti, Eclipsing Binary), including automated report generation and comparative performance metrics analysis.',
            'tech' => ['Python', 'scikit-learn', 'Jupyter', 'Machine Learning', 'Pandas'],
            'category' => 'academico',
            'year' => '2024',
            'repo' => 'https://github.com/Fern2906/ml-astronomical-classification',
            'demo' => '',
        ],
        [
            'id' => 'numi',
            'title' => 'NUMI — Vacation Rentals',
            'description' => 'Mobile vacation rental application built with Flutter featuring local persistence using SQLite. Includes property catalog and listings, search filters, reservation system, and integration of geolocation APIs with interactive mapping.',
            'tech' => ['Dart', 'Flutter', 'SQLite', 'Geolocation', 'APIs'],
            'category' => 'personal',
            'year' => '2025',
            'repo' => '',
            'demo' => 'https://youtube.com/shorts/ILPmVhhK3k4?si=257RD3wCrsZ8gz7f',
        ],
        [
            'id' => 'portafolio-web',
            'title' => 'Personal Web Portfolio',
            'description' => 'Reactive and modular web portfolio built with Laravel 11, Livewire 3, and Tailwind CSS, designed to showcase software projects, professional experience, and technical skills with a modern layout and dark mode support.',
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

    public function setFilter(string $category): void
    {
        $this->filter = $category;
    }

    public function render()
    {
        return view('livewire.projects-list');
    }
}