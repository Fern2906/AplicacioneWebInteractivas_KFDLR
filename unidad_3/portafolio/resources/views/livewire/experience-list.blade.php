<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Career Path</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Experience & Education</h1>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            A summary of my professional experience and academic background.
        </p>
    </header>

    <div class="mt-8 flex flex-wrap items-center gap-3">
        <div class="inline-flex flex-wrap gap-1 rounded-lg border border-gray-200 bg-white p-1 shadow-2xs dark:border-neutral-700 dark:bg-neutral-800">
            @foreach ($filters as $key => $label)
                <button
                    type="button"
                    wire:click="setFilter('{{ $key }}')"
                    @if ($filter === $key) aria-pressed="true" @else aria-pressed="false" @endif
                    class="rounded-md px-3 py-1.5 text-sm font-medium transition-colors {{ $filter === $key
                        ? 'bg-blue-600 text-white'
                        : 'text-gray-600 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <p class="text-sm text-gray-500 dark:text-neutral-400">
            {{ count($this->filteredItems) }} {{ count($this->filteredItems) === 1 ? 'entry' : 'entries' }}
        </p>
    </div>

    <div class="mt-10 max-w-3xl" wire:loading.class="opacity-60">
        @if (count($this->filteredItems) > 0)
            <ol class="relative ms-3 border-s border-gray-200 dark:border-neutral-700">
                @foreach ($this->filteredItems as $item)
                    <livewire:timeline-item :item="$item" wire:key="experience-{{ $item['id'] }}" />
                @endforeach
            </ol>
        @else
            <div class="rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-sm text-gray-500 dark:text-neutral-400">
                    No entries for this filter.
                </p>
            </div>
        @endif
    </div>

    <div class="mt-16">
        <livewire:cta
            title="Want to know more?"
            description="You can explore my projects or reach out directly to discuss job opportunities or collaborations."
            button-text="Contact Me"
            button-url="mailto:kevinfernando1906@outlook.com"
            secondary-button-text="View Projects"
            :secondary-button-url="route('projects')"
        />
    </div>
</div>
