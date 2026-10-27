<?php

namespace App\Livewire;

use Livewire\Component;

class Link extends Component
{
    public string $url = '';
    public string $label = '';

    public function mount(string $url = '', string $label = ''): void
    {
        $this->url = $url;
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.link');
    }
}
