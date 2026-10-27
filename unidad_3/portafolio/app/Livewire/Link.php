<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;

class Link extends Component
{
    #[Url(as: 'url', history: true)]
    public $url;
    public string $label;
    public function render()
    {
        return view('livewire.link');
    }
}
