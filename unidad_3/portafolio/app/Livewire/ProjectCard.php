<?php

namespace App\Livewire;

use Livewire\Component;

class ProjectCard extends Component
{
    public array $project = [];

    public function mount(array $project = []): void
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.project-card');
    }
}
