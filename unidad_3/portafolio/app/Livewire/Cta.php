<?php

namespace App\Livewire;

use Livewire\Component;

class Cta extends Component
{
    public string $title = '¿Trabajamos juntos?';

    public string $description = 'Estoy abierto a proyectos, oportunidades laborales y colaboraciones. Escríbeme y conversemos.';

    public string $buttonText = 'Contactarme';

    public string $buttonUrl = 'mailto:kevinfernando1906@outlook.com';

    public ?string $secondaryButtonText = 'LinkedIn';

    public ?string $secondaryButtonUrl = 'https://www.linkedin.com/in/de-leon-ramirez-kevin-fernando-1b59741bb';

    public function mount(
        string $title = '¿Trabajamos juntos?',
        string $description = 'Estoy abierto a proyectos, oportunidades laborales y colaboraciones. Escríbeme y conversemos.',
        string $buttonText = 'Contactarme',
        string $buttonUrl = 'mailto:kevinfernando1906@outlook.com',
        ?string $secondaryButtonText = 'LinkedIn',
        ?string $secondaryButtonUrl = 'https://www.linkedin.com/in/de-leon-ramirez-kevin-fernando-1b59741bb'
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
