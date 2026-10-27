<?php

namespace App\Livewire;

use Livewire\Component;

class Tab extends Component
{
    public string $label;
    public string $url;
    public bool $active = false;

    public function mount(string $label, string $url, bool $active = false): void
    {
        $this->label = $label;
        $this->url = $url;
        $this->active = $active;
    }

    public function isActive(): bool
    {
        $current = trim(request()->path(), '/');
        $target = trim($this->url, '/');

        if ($target === '') {
            return $current === '';
        }

        return request()->is($target) || request()->is($target . '/*');
    }

    public function render()
    {
        return view('livewire.tab');
    }
}
