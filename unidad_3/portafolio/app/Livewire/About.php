<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public string $sectionBadge = 'Sobre mí';
    public string $title = 'Un poco de contexto';

    public array $paragraphs = [
        'Soy estudiante de desarrollo de aplicaciones web y me apasiona convertir ideas en productos funcionales. Disfruto especialmente el trabajo con componentes reutilizables, la organización del código y las interfaces simples que se sienten rápidas.',
        'En este portafolio reúno los proyectos que he construido y las experiencias que han marcado mi formación como desarrollador.',
    ];

    public array $skills = [
        'Laravel',
        'Livewire',
        'PHP',
        'Tailwind CSS',
        'JavaScript',
        'MySQL',
        'Git',
    ];

    public function render()
    {
        return view('livewire.about');
    }
}
