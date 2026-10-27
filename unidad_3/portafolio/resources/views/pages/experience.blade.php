<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::portfolio')] #[Title('Experiencia')] class extends Component {
    public string $filter = 'all';

    public array $filters = [
        'all' => 'Todo',
        'trabajo' => 'Trabajo',
        'educacion' => 'Educación',
    ];

    public array $items = [
        [
            'id' => 'naesan-ventas',
            'type' => 'trabajo',
            'period' => 'Mar 2025 – Jun 2025',
            'title' => 'Vendedor y Gestión de Tienda de Mascotas',
            'organization' => 'Naesan',
            'description' => 'Venta y asesoramiento especializado a clientes para la selección de productos para sus mascotas, además de la administración, control y auditoría de inventario del local comercial.',
            'tags' => ['Atención al Cliente', 'Ventas', 'Control de Inventario', 'Asesoramiento'],
        ],
        [
            'id' => 'gama-electrics-obra',
            'type' => 'trabajo',
            'period' => 'Jul 2024 – Sep 2024',
            'title' => 'Ayudante de Obra — Instalación Eléctrica',
            'organization' => 'Gama Electrics — Proyecto Arena Potosí',
            'description' => 'Instalación de redes eléctricas y sistemas de cableado en Arena Potosí, garantizando el cumplimiento de requerimientos del proyecto y administrando el inventario de materiales e insumos.',
            'tags' => ['Instalación Eléctrica', 'Cableado', 'Arena Potosí', 'Gestión de Inventario'],
        ],
        [
            'id' => 'gama-electrics-redes',
            'type' => 'trabajo',
            'period' => 'Jun 2024 – Jul 2024',
            'title' => 'Ayudante de Administrador de Redes',
            'organization' => 'Gama Electrics',
            'description' => 'Administración y reorganización de direcciones IP y configuraciones de red por cliente, ajustándolas a la nueva reestructuración de la base de datos. Reconfiguración de routers de cada cliente para optimizar la eficiencia del servicio.',
            'tags' => ['Administración de Redes', 'Direccionamiento IP', 'Routers', 'Bases de datos'],
        ],
        [
            'id' => 'uaslp-ingenieria',
            'type' => 'educacion',
            'period' => 'Graduación esperada: Jul 2027',
            'title' => 'Ingeniería en Sistemas Inteligentes',
            'organization' => 'Universidad Autónoma de San Luis Potosí — San Luis Potosí, MX',
            'description' => 'Formación universitaria en diseño de software, arquitectura de sistemas, desarrollo web y móvil, inteligencia artificial, modelos de machine learning y bases de datos relacionales.',
            'tags' => ['Sistemas Inteligentes', 'UASLP', 'Machine Learning', 'Full-Stack'],
        ],
        [
            'id' => 'idiomas',
            'type' => 'educacion',
            'period' => 'Competencia técnica',
            'title' => 'Idiomas y Comunicación',
            'organization' => 'Español e Inglés',
            'description' => 'Español nativo e Inglés con nivel B1 (Intermedio), con habilidad para consultar documentación técnica especializada, participar en equipos multidisciplinarios y redactar especificaciones.',
            'tags' => ['Español (Nativo)', 'Inglés (B1 — Intermedio)', 'Documentación Técnica'],
        ],
    ];

    #[Computed]
    public function filteredItems(): array
    {
        if ($this->filter === 'all') {
            return $this->items;
        }

        return array_values(array_filter(
            $this->items,
            fn (array $item) => $item['type'] === $this->filter
        ));
    }

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }
}; ?>

<div class="mx-auto w-full max-w-5xl px-4 py-16">
    <header class="max-w-2xl">
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-500">Trayectoria</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Experiencia y Educación</h1>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            Un recorrido por mi trayectoria profesional, experiencia técnica en campo y formación académica.
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
            description="Puedes explorar mis proyectos o escribirme directamente para platicar sobre una vacante o colaboración."
            button-text="Contactarme"
            button-url="mailto:kevinfernando1906@outlook.com"
            secondary-button-text="Ver proyectos"
            :secondary-button-url="route('projects')"
        />
    </div>
    </div>
</div>
