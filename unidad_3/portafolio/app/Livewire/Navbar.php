<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public array $navItems = [
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Proyectos', 'url' => '/projects'],
        ['label' => 'Experiencia', 'url' => '/experience'],
    ];

    public function render()
    {
        return view('livewire.navbar');
    }
}
