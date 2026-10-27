<?php

namespace App\Livewire;

use Livewire\Component;

class Hero extends Component
{
    public string $status = 'Disponible para proyectos y colaboraciones';

    public string $greeting = 'Hola, soy';

    public string $name = 'Kevin Fernando De León Ramírez';

    public string $role = 'Estudiante de Ing. en Sistemas Inteligentes | Desarrollador Full-Stack';

    public string $description = 'Estudiante en la Universidad Autónoma de San Luis Potosí enfocado en desarrollo Full-Stack y Sistemas Inteligentes. Construyo aplicaciones web modernas con Laravel y Livewire, apps móviles con Flutter y soluciones de Machine Learning con Python.';

    public string $avatarInitials = 'KF';

    public string $badgeTitle = 'San Luis Potosí, México';

    public string $badgeSubtitle = 'UASLP • Graduación esperada: Jul 2027';

    public array $techBadges = [
        'Laravel & Livewire',
        'Flutter & SQLite',
        'Python & Scikit-Learn',
        'Tailwind CSS',
    ];

    public function render()
    {
        return view('livewire.hero');
    }
}
