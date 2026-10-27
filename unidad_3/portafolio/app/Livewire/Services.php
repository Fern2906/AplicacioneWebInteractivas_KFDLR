<?php

namespace App\Livewire;

use Livewire\Component;

class Services extends Component
{
    public string $sectionBadge = 'Áreas de enfoque';

    public string $title = 'Soluciones en las que puedo ayudarte';

    public string $description = 'Especialidades técnicas respaldadas por proyectos reales y formación en Sistemas Inteligentes.';

    public array $services = [
        [
            'title' => 'Desarrollo Web Full-Stack',
            'description' => 'Aplicaciones completas con Laravel, Livewire, Alpine.js y Tailwind CSS. Implementación de lógica de negocio, pruebas unitarias y generación de reportes interactivos.',
            'icon' => 'code',
        ],
        [
            'title' => 'Desarrollo Móvil con Flutter',
            'description' => 'Creación de aplicaciones móviles para Android/iOS con Flutter, Dart y almacenamiento SQLite. Integración de mapas, geolocalización y APIs REST.',
            'icon' => 'sparkles',
        ],
        [
            'title' => 'Machine Learning y Redes',
            'description' => 'Modelos predictivos y clasificación con Python y scikit-learn (SVM, Random Forest), complementado con experiencia en administración de redes y routers.',
            'icon' => 'database',
        ],
    ];

    public function render()
    {
        return view('livewire.services');
    }
}
