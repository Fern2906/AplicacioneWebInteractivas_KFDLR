<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ExperienceList extends Component
{
    public string $filter = 'all';

    public array $filters = [
        'all' => 'All',
        'trabajo' => 'Work',
        'educacion' => 'Education',
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

    public function setFilter(string $type): void
    {
        $this->filter = $type;
    }

    public function render()
    {
        return view('livewire.experience-list');
    }
}
