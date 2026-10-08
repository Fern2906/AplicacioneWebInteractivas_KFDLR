<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JugadorSeeder extends Seeder
{
    /**
     * Crea jugadores de prueba con rol jugador.
     */
    public function run(): void
    {
        $jugadores = [
            ['name' => 'Carlos Mendoza',   'email' => 'carlos@example.com'],
            ['name' => 'Sofía Ramírez',    'email' => 'sofia@example.com'],
            ['name' => 'Andrés Torres',    'email' => 'andres@example.com'],
            ['name' => 'Valentina Cruz',   'email' => 'valentina@example.com'],
            ['name' => 'Diego Herrera',    'email' => 'diego@example.com'],
            ['name' => 'Camila Vargas',    'email' => 'camila@example.com'],
            ['name' => 'Mateo Jiménez',    'email' => 'mateo@example.com'],
            ['name' => 'Isabella López',   'email' => 'isabella@example.com'],
        ];

        foreach ($jugadores as $jugador) {
            User::firstOrCreate(
                ['email' => $jugador['email']],
                [
                    'name' => $jugador['name'],
                    'password' => Hash::make('password'),
                    'rol' => 'jugador',
                ]
            );
        }
    }
}
