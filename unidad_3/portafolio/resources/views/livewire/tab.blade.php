@php($active = $this->isActive())
<a href="{{ $url }}" wire:navigate @if ($active) aria-current="page" @endif
    class="rounded-lg px-3 py-2 font-medium transition-colors {{ $active
        ? 'bg-blue-50 text-blue-600 dark:bg-neutral-800 dark:text-blue-500'
        : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:hover:text-white' }}">
    {{ $label }}
</a>
