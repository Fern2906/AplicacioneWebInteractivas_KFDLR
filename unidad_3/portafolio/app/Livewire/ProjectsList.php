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

    public function setFilter(string $category): void
    {
        $this->filter = $category;
    }

    public function render()
    {
        return view('livewire.projects-list');
    }
}
