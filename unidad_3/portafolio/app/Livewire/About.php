<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public string $sectionBadge = 'Sobre mí';

    public string $title = 'Sistemas Inteligentes & Desarrollo Full-Stack';

    public array $paragraphs = [
        '¡Hola! Soy Kevin Fernando De León Ramírez, estudiante de Ingeniería en Sistemas Inteligentes en la Universidad Autónoma de San Luis Potosí (graduación esperada: julio 2027) y desarrollador Full-Stack con sede en San Luis Potosí, México.',
        'Me apasiona diseñar y materializar software de alto impacto: desde plataformas web robustas con Laravel, Livewire y Tailwind CSS (como el Sistema CACEI para la automatización de métricas de rendimiento escolar), hasta aplicaciones móviles multiplataforma en Flutter con SQLite y mapas interactivos (NUMI), así como modelos predictivos de Machine Learning en Python sobre datos astronómicos masivos.',
        'Cuento además con experiencia en soporte y administración de redes IP, configuración de routers e instalaciones eléctricas, combinando sólidas bases técnicas con habilidades de adaptabilidad, pensamiento crítico, trabajo en equipo y aprendizaje continuo.',
    ];

    public array $skills = [
        'Python',
        'JavaScript',
        'PHP',
        'C / C++',
        'Dart',
        'Laravel',
        'Livewire',
        'Tailwind CSS',
        'React',
        'Angular',
        'Flutter',
        'Android Studio',
        'MySQL',
        'SQLite',
        'scikit-learn',
        'Jupyter',
        'Git',
        'Figma',
        'Jira',
    ];

    public array $softSkills = [
        'Resolución de problemas',
        'Trabajo en equipo',
        'Pensamiento crítico',
        'Adaptabilidad',
        'Comunicación efectiva',
        'Aprendizaje continuo',
        'Organización',
        'Creatividad',
    ];

    public array $languages = [
        'Español (Nativo)',
        'Inglés (B1 — Intermedio)',
    ];

    public function render()
    {
        return view('livewire.about');
    }
}
