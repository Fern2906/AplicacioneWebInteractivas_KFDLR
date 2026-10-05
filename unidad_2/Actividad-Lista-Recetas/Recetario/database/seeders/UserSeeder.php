<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("usuarios")->insert([
            [
                "nombre"     => "admin",
                "correo"     => "admin@gmail.com",
                "contrasena" => bcrypt("12345678"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nombre"     => "usuario",
                "correo"     => "usuario@gmail.com",
                "contrasena" => bcrypt("12345678"),
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ]);
    }
}