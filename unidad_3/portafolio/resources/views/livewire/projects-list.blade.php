<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Projects</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Proyectos</h1>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            Una selección de los proyectos en los que he trabajado. Filtra por tipo para explorar.
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
            {{ count($this->filteredProjects) }} {{ count($this->filteredProjects) === 1 ? 'proyecto' : 'proyectos' }}
        </p>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3" wire:loading.class="opacity-60">
        @forelse ($this->filteredProjects as $project)
            <livewire:project-card :project="$project" wire:key="project-{{ $project['id'] }}" />
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center dark:border-neutral-700 dark:bg-neutral-800">
                <p class="text-sm text-gray-500 dark:text-neutral-400">
                    No hay proyectos en esta categoría todavía.
                </p>
            </div>
        @endforelse
    </div>
</div>
