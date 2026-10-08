<?php

namespace Database\Seeders;

use App\Models\Torneo;
use Illuminate\Database\Seeder;

class TorneoSeeder extends Seeder
{
    /**
     * Crea torneos de prueba con distintos estados.
     */
    public function run(): void
    {
        $torneos = [
            [
                'nombre' => 'Copa Verano 2026',
                'juego' => 'League of Legends',
                'fecha_futura' => now()->addDays(15),
                'cupo' => 16,
                'descripcion' => 'Torneo de LoL 5v5. Reglas estándar de ranked. Premio: skin exclusiva para el equipo ganador.',
                'estado' => true,
            ],
            [
                'nombre' => 'Torneo Relámpago FIFA',
                'juego' => 'EA FC 25',
                'fecha_futura' => now()->addDays(7),
                'cupo' => 8,
                'descripcion' => 'Torneo de FIFA de eliminación directa. Cada partido se juega a dos tiempos de 6 minutos.',
                'estado' => true,
            ],
            [
                'nombre' => 'Campeonato Valorant',
                'juego' => 'Valorant',
                'fecha_futura' => now()->addDays(30),
                'cupo' => 20,
                'descripcion' => 'Competencia de Valorant formato suizo. Se aceptan equipos de 5 jugadores.',
                'estado' => true,
            ],
            [
                'nombre' => 'Clásico de Ajedrez Online',
                'juego' => 'Ajedrez',
                'fecha_futura' => now()->addDays(10),
                'cupo' => 32,
                'descripcion' => 'Torneo de ajedrez con control de tiempo blitz (5+3). Plataforma: Chess.com.',
                'estado' => true,
            ],
            [
                'nombre' => 'Torneo Retro Mario Kart',
                'juego' => 'Mario Kart 8 Deluxe',
                'fecha_futura' => now()->addDays(20),
                'cupo' => 12,
                'descripcion' => 'Solo pistas retro habilitadas. Sin items. Formato todos contra todos.',
                'estado' => true,
            ],
            [
                'nombre' => 'Liga Fútbol 7',
                'juego' => 'Fútbol',
                'fecha_futura' => now()->addDays(5),
                'cupo' => 10,
                'descripcion' => 'Liga presencial de fútbol 7. Canchas del polideportivo norte. Llevar uniforme.',
                'estado' => true,
            ],
            [
                'nombre' => 'Torneo Cerrado (ejemplo)',
                'juego' => 'Counter-Strike 2',
                'fecha_futura' => now()->addDays(3),
                'cupo' => 16,
                'descripcion' => 'Torneo de CS2 marcado como inactivo por el administrador.',
                'estado' => false,
            ],
            [
                'nombre' => 'Torneo Pasado (ejemplo)',
                'juego' => 'Rocket League',
                'fecha_futura' => now()->subDays(5),
                'cupo' => 8,
                'descripcion' => 'Torneo que ya finalizó. No debería aparecer en el listado público.',
                'estado' => true,
            ],
        ];

        foreach ($torneos as $datos) {
            Torneo::firstOrCreate(
                ['nombre' => $datos['nombre']],
                $datos
            );
        }
    }
}
