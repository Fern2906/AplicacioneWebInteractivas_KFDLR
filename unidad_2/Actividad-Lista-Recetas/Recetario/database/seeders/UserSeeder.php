<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("usuarios")->insert([
            "nombre"=>"admin",
            "correo"=>"admin@gmail.com",
            "contrasena"=>bcrypt("12345678")
        ]);
    }
}
