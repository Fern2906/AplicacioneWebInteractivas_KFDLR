<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectsList extends Component
{
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

    public function setFilter(string $category): void
    {
        $this->filter = $category;
    }

    public function render()
    {
        return view('livewire.projects-list');
    }
}
