<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public string $sectionBadge = 'About Me';

    public string $title = 'Intelligent Systems & Full-Stack Development';

    public array $paragraphs = [
        "I'm Kevin Fernando De León Ramírez, an Intelligent Systems Engineering student at the Autonomous University of San Luis Potosí (UASLP) (expected graduation: July 2027) and a Software Developer in training based in San Luis Potosí, Mexico.",
        'I am passionate about designing and building high-impact software solutions, from robust web platforms with Laravel, Livewire, and Tailwind CSS, to cross-platform mobile applications with Flutter and SQLite, as well as Machine Learning predictive models in Python.',
        'Currently working as an Applications Development Intern at Daikin Manufacturing México, contributing to software solutions for internal processes. Previously, I worked as an intern at the Faculty of Chemical Sciences at UASLP, developing modules for its web system. I have a strong focus on continuous learning and problem solving.',
    ];

    public array $skills = [
        'Python',
        'JavaScript',
        'PHP',
        'Laravel',
        'React',
        'Angular',
        'MySQL',
        'SQL',
        'Git',
    ];

    public array $softSkills = [
        'Problem Solving',
        'Teamwork',
        'Critical Thinking',
        'Adaptability',
        'Effective Communication',
        'Continuous Learning',
        'Organization',
        'Creativity',
    ];

    public array $languages = [
        'Spanish (Native)',
        'English (B1 - Intermediate)',
    ];

    public function render()
    {
        return view('livewire.about');
    }
}
