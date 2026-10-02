<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('tablero principal de tareas carga exitosamente con componentes', function () {
    $tareaPorHacer = Task::factory()->create([
        'titulo' => 'Planificar Sprint',
        'estado' => 'por_hacer',
        'prioridad' => 'alta',
    ]);

    $tareaEnCurso = Task::factory()->create([
        'titulo' => 'Desarrollar vistas Apple',
        'estado' => 'en_curso',
        'prioridad' => 'media',
    ]);

    $tareaTerminada = Task::factory()->create([
        'titulo' => 'Configurar Tailwind',
        'estado' => 'terminado',
        'prioridad' => 'baja',
    ]);

    $response = $this->get(route('task.index'));

    $response->assertOk();
    $response->assertViewIs('tasks.index');
    $response->assertSee('Tablero de Tareas');
    $response->assertSee('Planificar Sprint');
    $response->assertSee('Desarrollar vistas Apple');
    $response->assertSee('Configurar Tailwind');
    $response->assertSee('Por hacer');
    $response->assertSee('En curso');
    $response->assertSee('Terminado');
});

test('vista de creación de tarea se muestra correctamente', function () {
    $response = $this->get(route('task.create'));

    $response->assertOk();
    $response->assertViewIs('tasks.create');
    $response->assertSee('Nueva Tarea');
    $response->assertSee('Título de la tarea');
    $response->assertSee('Fecha de vencimiento');
});

test('puede crear una nueva tarea mediante el formulario', function () {
    $datos = [
        'titulo' => 'Tarea de Prueba Apple',
        'descripcion' => 'Descripción detallada de la tarea',
        'estado' => 'por_hacer',
        'prioridad' => 'alta',
        'vencimiento' => now()->addDays(5)->format('Y-m-d'),
    ];

    $response = $this->post(route('task.store'), $datos);

    $response->assertRedirect(route('task.index'));
    $response->assertSessionHas('exito', 'Tarea creada.');

    $this->assertDatabaseHas('tasks', [
        'titulo' => 'Tarea de Prueba Apple',
        'estado' => 'por_hacer',
        'prioridad' => 'alta',
    ]);
});

test('vista de detalle de tarea se muestra correctamente', function () {
    $tarea = Task::factory()->create([
        'titulo' => 'Tarea con Detalle Extenso',
        'descripcion' => 'Esta es una descripción enriquecida con información de soporte.',
        'estado' => 'en_curso',
        'prioridad' => 'alta',
    ]);

    $response = $this->get(route('task.show', $tarea));

    $response->assertOk();
    $response->assertViewIs('tasks.show');
    $response->assertSee('Tarea con Detalle Extenso');
    $response->assertSee('Esta es una descripción enriquecida con información de soporte.');
    $response->assertSee('Cambiar estado directamente');
});

test('vista de edición de tarea carga con los datos existentes', function () {
    $tarea = Task::factory()->create([
        'titulo' => 'Tarea para Modificar',
        'estado' => 'por_hacer',
    ]);

    $response = $this->get(route('task.edit', $tarea));

    $response->assertOk();
    $response->assertViewIs('tasks.edit');
    $response->assertSee('Editar Tarea');
    $response->assertSee('Tarea para Modificar');
});

test('puede actualizar una tarea existente', function () {
    $tarea = Task::factory()->create([
        'titulo' => 'Título Inicial',
        'estado' => 'por_hacer',
        'prioridad' => 'baja',
    ]);

    $datosActualizados = [
        'titulo' => 'Título Actualizado Fluidamente',
        'descripcion' => 'Nueva descripción',
        'estado' => 'en_curso',
        'prioridad' => 'alta',
        'vencimiento' => now()->addDays(2)->format('Y-m-d'),
    ];

    $response = $this->put(route('task.update', $tarea), $datosActualizados);

    $response->assertRedirect(route('task.index'));
    $response->assertSessionHas('exito', 'Tarea actualizada.');

    $this->assertDatabaseHas('tasks', [
        'id' => $tarea->id,
        'titulo' => 'Título Actualizado Fluidamente',
        'estado' => 'en_curso',
        'prioridad' => 'alta',
    ]);
});

test('puede cambiar el estado rápidamente a terminado', function () {
    $tarea = Task::factory()->create([
        'estado' => 'en_curso',
    ]);

    $response = $this->patch(route('task.change-status', $tarea), [
        'estado' => 'terminado',
    ]);

    $response->assertRedirect(route('task.index'));
    $response->assertSessionHas('exito', 'Estado actualizado.');

    expect($tarea->fresh()->estado)->toBe('terminado');
});

test('puede eliminar una tarea', function () {
    $tarea = Task::factory()->create([
        'titulo' => 'Tarea a Eliminar',
    ]);

    $response = $this->delete(route('task.destroy', $tarea));

    $response->assertRedirect(route('task.index'));
    $response->assertSessionHas('exito', 'Tarea eliminada.');

    $this->assertDatabaseMissing('tasks', [
        'id' => $tarea->id,
    ]);
});

test('puede filtrar tareas por búsqueda y estado', function () {
    Task::factory()->create([
        'titulo' => 'Aprender Swift',
        'estado' => 'por_hacer',
    ]);

    Task::factory()->create([
        'titulo' => 'Aprender Laravel',
        'estado' => 'en_curso',
    ]);

    $response = $this->get(route('task.index', ['q' => 'Swift']));

    $response->assertOk();
    $response->assertSee('Aprender Swift');
    $response->assertDontSee('Aprender Laravel');
});
