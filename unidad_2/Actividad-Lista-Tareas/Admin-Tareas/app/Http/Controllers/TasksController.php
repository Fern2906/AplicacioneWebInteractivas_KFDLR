<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $peticion)
    {
        $consulta = Task::query();

        if (array_key_exists($peticion->query('estado'), Task::ESTADOS)) {
            $consulta->where('estado', $peticion->query('estado'));
        }

        if (array_key_exists($peticion->query('prioridad'), Task::PRIORIDADES)) {
            $consulta->where('prioridad', $peticion->query('prioridad'));
        }

        if ($peticion->filled('q')) {
            $consulta->where('titulo', 'like', '%'.$peticion->query('q').'%');
        }

        $tareas = $consulta->orderByDesc('created_at')->get()->groupBy('estado');

        return view('tasks.index', [
            'tareasPorEstado' => $tareas,
            'estados' => Task::ESTADOS,
            'prioridades' => Task::PRIORIDADES,
            'filtros' => $peticion->only(['estado', 'prioridad', 'q']),
        ]);
    }

    public function create()
    {
        return view('tasks.create', [
            'estados' => Task::ESTADOS,
            'prioridades' => Task::PRIORIDADES,
        ]);
    }

    public function store(Request $peticion)
    {
        $datos = $this->validar($peticion);

        Task::create($datos);

        return redirect()->route('tasks.index')->with('exito', 'Tarea creada.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', [
            'tarea' => $task,
            'estados' => Task::ESTADOS,
            'prioridades' => Task::PRIORIDADES,
        ]);
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'tarea' => $task,
            'estados' => Task::ESTADOS,
            'prioridades' => Task::PRIORIDADES,
        ]);
    }

    public function update(Request $peticion, Task $task)
    {
        $datos = $this->validar($peticion);

        $task->update($datos);

        return redirect()->route('tasks.index')->with('exito', 'Tarea actualizada.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('exito', 'Tarea eliminada.');
    }

    public function changeStatus(Request $peticion, Task $task)
    {
        $datos = $peticion->validate(
            ['estado' => 'required|in:por_hacer,en_curso,hecha'],
            ['estado.required' => 'El estado es obligatorio.', 'estado.in' => 'El estado no es válido.']
        );

        $task->update($datos);

        return redirect()->route('tasks.index')->with('exito', 'Estado actualizado.');
    }

    protected function validar(Request $peticion): array
    {
        return $peticion->validate(
            [
                'titulo' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:2000',
                'estado' => 'required|in:por_hacer,en_curso,hecha',
                'prioridad' => 'required|in:baja,media,alta',
                'vencimiento' => 'nullable|date',
            ],
            [
                'titulo.required' => 'El título es obligatorio.',
                'titulo.max' => 'El título no puede tener más de 255 caracteres.',
                'descripcion.max' => 'La descripción no puede tener más de 2000 caracteres.',
                'estado.required' => 'El estado es obligatorio.',
                'estado.in' => 'El estado no es válido.',
                'prioridad.required' => 'La prioridad es obligatoria.',
                'prioridad.in' => 'La prioridad no es válida.',
                'vencimiento.date' => 'La fecha de vencimiento no es válida.',
            ]
        );
    }
}