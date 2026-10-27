<?php

namespace App\Livewire;

use Livewire\Component;

class Cta extends Component
{
    public string $title = '¿Trabajamos juntos?';
    public string $description = 'Estoy abierto a proyectos, prácticas y colaboraciones. Escríbeme y conversemos.';
    public string $buttonText = 'Contactarme';
    public string $buttonUrl = 'mailto:correo@ejemplo.com';
    public ?string $secondaryButtonText = null;
    public ?string $secondaryButtonUrl = null;

    public function mount(
        string $title = '¿Trabajamos juntos?',
        string $description = 'Estoy abierto a proyectos, prácticas y colaboraciones. Escríbeme y conversemos.',
        string $buttonText = 'Contactarme',
        string $buttonUrl = 'mailto:correo@ejemplo.com',
        ?string $secondaryButtonText = null,
        ?string $secondaryButtonUrl = null
    ): void {
        $this->title = $title;
        $this->description = $description;
        $this->buttonText = $buttonText;
        $this->buttonUrl = $buttonUrl;
        $this->secondaryButtonText = $secondaryButtonText;
        $this->secondaryButtonUrl = $secondaryButtonUrl;
    }

    public function render()
    {
        return view('livewire.cta');
    }
}
