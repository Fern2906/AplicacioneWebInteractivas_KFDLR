<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('dificultades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo')->unique();
            $table->string('contrasena');
            $table->timestamps();
        });

        Schema::create('recetas', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');

            $table->unsignedInteger('tiempo');

            $table->text('ingredientes');
            $table->text('pasos');
            $table->text('nota')->nullable();
            $table->string('imagen')->nullable();

            $table->foreignId('usuario_id')
                  ->constrained('usuarios')
                  ->onDelete('cascade');

            $table->foreignId('dificultad_id')
                  ->constrained('dificultades')
                  ->onDelete('cascade');

            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recetas');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('dificultades');
        Schema::dropIfExists('categorias');
    }
};