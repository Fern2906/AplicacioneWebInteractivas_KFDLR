<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DificultadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dificultades')->insert([
            [
                'nombre' => 'Fácil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Intermedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Difícil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}