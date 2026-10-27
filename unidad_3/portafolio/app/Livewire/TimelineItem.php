<?php

namespace App\Livewire;

use Livewire\Component;

class TimelineItem extends Component
{
    public array $item = [];

    public function mount(array $item = []): void
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.timeline-item');
    }
}
