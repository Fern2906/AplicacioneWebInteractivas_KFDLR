<?php

namespace App\Livewire;

use Livewire\Component;

class Services extends Component
{
    public string $sectionBadge = 'Core Competencies';

    public string $title = 'Solutions & Expertise';

    public string $description = 'Full-stack engineering capabilities backed by real-world enterprise applications, modern web frameworks, and solid software architecture.';

    public array $services = [
        [
            'title' => 'Full-Stack Web Applications',
            'description' => 'Scalable, reactive web platforms using PHP with Laravel (Inertia.js, React, Livewire) and TypeScript. Focused on modular architecture, clean code, and intuitive interfaces.',
            'icon' => 'code',
        ],
        [
            'title' => 'Enterprise Backend & .NET Solutions',
            'description' => 'Robust backend services, API integrations, and corporate business logic using C# with ASP.NET Core and SQL Server, as well as complex file processing workflows.',
            'icon' => 'database',
        ],
        [
            'title' => 'Database and ERP managmente',
            'description' => 'Relational database modeling with MySQL and SQL Server, containerized environments using Docker, unit testing suites, and managment in ERP systems such as SAP and Oracle.',
            'icon' => 'sparkles',
        ],
    ];

    public function render()
    {
        return view('livewire.services');
    }
}