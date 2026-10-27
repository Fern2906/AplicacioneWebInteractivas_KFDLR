<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ExperienceList extends Component
{
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

    public function setFilter(string $type): void
    {
        $this->filter = $type;
    }

    public function render()
    {
        return view('livewire.experience-list');
    }
}
