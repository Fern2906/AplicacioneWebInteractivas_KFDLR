<?php

namespace App\Livewire;

use Livewire\Component;

class Tab extends Component
{
    public string $label;
    public string $url;
    public bool $active;
    public function mount(string $label, string $url, bool $active = false)
    {
        $this->label = $label;
        $this->url = $url;
        $this->active = $active;
    }
    public function isActive()
    {
        return request()->routeIs(str_replace('/', '', $this->url));
    }
    public function render()
    {
        return view('livewire.tab');
    }
}
