<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Desayuno',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Almuerzo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cena',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Postres',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Bebida',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}