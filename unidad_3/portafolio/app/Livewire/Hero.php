<?php

namespace App\Livewire;

use Livewire\Component;

class Hero extends Component
{
    public string $status = 'Available for projects and collaborations';

    public string $greeting = "Hello, I'm";

    public string $name = 'Kevin Fernando De León Ramírez';

    public string $role = 'Intelligent Systems Engineering Student | Applications Development Intern at Daikin Manufacturing México';

    public string $description = 'Intelligent Systems Engineering student at UASLP and Software Developer in training, with experience in software development and web applications. 
                                Currently working as an Applications Development Intern at Daikin Manufacturing México, contributing to software solutions for internal processes. 
                                Interested in Software Engineering, Full-Stack Development, Backend Development, and Machine Learning, with a strong focus on continuous learning and problem solving.';

    public string $avatarInitials = 'KF';

    public string $badgeTitle = 'Portfolio 2026';

    public string $badgeSubtitle = 'Projects & Experience';

    public array $techBadges = [
        'Laravel & Livewire',
        'React & Angular',
        'Flutter & Mobile Apps',
        'Python & Machine Learning',
        'PHP & MySQL',
    ];

    public function render()
    {
        return view('livewire.hero');
    }
}
