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
                ['label' => 'Github', 'url' => 'https://github.com/k-f-dlr'],
                ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/k-f-dlr'],
                ['label' => 'Correo electrónico', 'url' => '[EMAIL_ADDRESS]'],
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
