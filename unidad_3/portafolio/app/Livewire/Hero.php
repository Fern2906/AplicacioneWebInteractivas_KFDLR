<?php

namespace App\Livewire;

use Livewire\Component;

class Hero extends Component
{
    public string $status = 'Disponible para proyectos';
    public string $greeting = 'Hola, soy';
    public string $name = 'KFDLR';
    public string $role = 'Desarrollador Web Full Stack';
    public string $description = 'Construyo aplicaciones web claras, rápidas y mantenibles. Trabajo principalmente con Laravel, Livewire y Tailwind CSS, cuidando tanto la lógica del backend como la experiencia de usuario.';
    public string $avatarInitials = 'KF';
    public string $badgeTitle = 'Portafolio 2026';
    public string $badgeSubtitle = 'Proyectos y experiencia';

    public array $techBadges = [
        'Laravel + Livewire',
        'Tailwind CSS',
        'Preline UI',
    ];

    public function render()
    {
        return view('livewire.hero');
    }
}
