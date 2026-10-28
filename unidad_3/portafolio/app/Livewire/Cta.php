<?php

namespace App\Livewire;

use Livewire\Component;

class Cta extends Component
{
    public string $title = "Let's work together?";

    public string $description = "I'm open to projects, job opportunities, and collaborations. Feel free to reach out!";

    public string $buttonText = 'Contact Me';

    public string $buttonUrl = 'mailto:kevinfernando1906@outlook.com';

    public ?string $secondaryButtonText = 'LinkedIn';

    public ?string $secondaryButtonUrl = 'https://www.linkedin.com/in/de-leon-ramirez-kevin-fernando-1b59741bb';

    public function mount(
        string $title = "Let's work together?",
        string $description = "I'm open to projects, job opportunities, and collaborations. Feel free to reach out!",
        string $buttonText = 'Contact Me',
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
