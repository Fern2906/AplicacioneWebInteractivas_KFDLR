<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cuenta administrador
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'rol' => 'administrador',
            ]
        );

        // Jugador de prueba genérico
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'test_user',
                'password' => Hash::make('password'),
                'rol' => 'jugador',
            ]
        );

        $this->call([
            JugadorSeeder::class,
            TorneoSeeder::class,
        ]);
    }
}
