<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Experience</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Experiencia</h1>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            Un recorrido por mi trayectoria profesional y académica.
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
            {{ count($this->filteredItems) }} {{ count($this->filteredItems) === 1 ? 'entrada' : 'entradas' }}
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
                    No hay entradas para este filtro.
                </p>
            </div>
        @endif
    </div>

    <div class="mt-16">
        <livewire:cta
            title="¿Quieres conocer más?"
            description="Puedes revisar mis proyectos o escribirme directamente para conversar sobre una oportunidad."
            button-text="Contactarme"
            button-url="mailto:correo@ejemplo.com"
            secondary-button-text="Ver proyectos"
            :secondary-button-url="route('projects')"
        />
    </div>
</div>
