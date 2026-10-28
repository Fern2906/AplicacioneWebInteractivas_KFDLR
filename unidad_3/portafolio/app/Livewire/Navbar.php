<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public array $navItems = [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Projecs', 'url' => '/projects'],
        ['label' => 'Experience', 'url' => '/experience'],
    ];

    public function render()
    {
        return view('livewire.navbar');
    }
}
