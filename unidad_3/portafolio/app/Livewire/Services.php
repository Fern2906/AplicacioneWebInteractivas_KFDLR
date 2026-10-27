<?php

namespace App\Livewire;

use Livewire\Component;

class Services extends Component
{
    public string $sectionBadge = 'Servicios';
    public string $title = 'En qué puedo ayudarte';
    public string $description = 'Estas son las áreas en las que concentro mi trabajo.';

    public array $services = [
        [
            'title' => 'Aplicaciones web',
            'description' => 'Desarrollo con Laravel y Livewire: rutas, componentes reactivos, validación y lógica de negocio.',
            'icon' => 'code',
        ],
        [
            'title' => 'Interfaces',
            'description' => 'Maquetación responsive con Tailwind CSS y componentes de Preline UI, con atención al detalle.',
            'icon' => 'sparkles',
        ],
        [
            'title' => 'Datos y APIs',
            'description' => 'Modelado de bases de datos, consultas con Eloquent y consumo o creación de APIs REST.',
            'icon' => 'database',
        ],
    ];

    public function render()
    {
        return view('livewire.services');
    }
}
