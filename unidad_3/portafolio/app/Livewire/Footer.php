<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public int $year;

    public array $sections = [
        [
            'name' => 'Navegación',
            'links' => [
                ['label' => 'Inicio', 'url' => '/'],
                ['label' => 'Proyectos', 'url' => '/projects'],
                ['label' => 'Experiencia', 'url' => '/experience'],
            ],
        ],
        [
            'name' => 'Contacto',
            'links' => [
                ['label' => 'GitHub (Fern2906)', 'url' => 'https://github.com/Fern2906'],
                ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/de-leon-ramirez-kevin-fernando-1b59741bb'],
                ['label' => 'kevinfernando1906@outlook.com', 'url' => 'mailto:kevinfernando1906@outlook.com'],
                ['label' => '+52 44 44 84 51 43', 'url' => 'tel:4444845143'],
            ],
        ],
    ];

    public function mount(): void
    {
        $this->year = date('Y');
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
