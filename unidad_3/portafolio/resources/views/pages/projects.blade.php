<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Projects')] class extends Component {
    //
}; ?>

<livewire:projects-list />
