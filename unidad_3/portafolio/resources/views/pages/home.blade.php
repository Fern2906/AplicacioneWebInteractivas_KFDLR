<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Home')] class extends Component {
    //
}; ?>

<div class="mx-auto w-full max-w-5xl px-4">
    <livewire:hero />

    <livewire:about />

    <livewire:services />

    <livewire:cta />
</div>
