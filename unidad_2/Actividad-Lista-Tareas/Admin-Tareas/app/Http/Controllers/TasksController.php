<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(Request $peticion)
    {
        $consulta = Tasks::query();

        if (array_key_exists($peticion->query('estado'), Tasks::ESTADOS)) {
            $consulta->where('estado', $peticion->query('estado'));
        }

        if (array_key_exists($peticion->query('prioridad'), Tasks::PRIORIDADES)) {
            $consulta->where('prioridad', $peticion->query('prioridad'));
        }

        if ($peticion->filled('q')) {
            $consulta->where('titulo', 'like', '%'.$peticion->query('q').'%');
        }

        $tareas = $consulta->orderByDesc('created_at')->get()->groupBy('estado');

        return view('Taskss.index', [
            'tareasPorEstado' => $tareas,
            'estados' => Tasks::ESTADOS,
            'prioridades' => Tasks::PRIORIDADES,
            'filtros' => $peticion->only(['estado', 'prioridad', 'q']),
        ]);
    }

    public function create()
    {
        return view('Taskss.create', [
            'estados' => Tasks::ESTADOS,
            'prioridades' => Tasks::PRIORIDADES,
        ]);
    }

    public function store(Request $peticion)
    {
        $datos = $this->validar($peticion);

        Tasks::create($datos);

        return redirect()->route('Taskss.index')->with('exito', 'Tarea creada.');
    }

    public function show(Tasks $Tasks)
    {
        return view('Taskss.show', [
            'tarea' => $Tasks,
            'estados' => Tasks::ESTADOS,
            'prioridades' => Tasks::PRIORIDADES,
        ]);
    }

    public function edit(Tasks $Tasks)
    {
        return view('Taskss.edit', [
            'tarea' => $Tasks,
            'estados' => Tasks::ESTADOS,
            'prioridades' => Tasks::PRIORIDADES,
        ]);
    }

    public function update(Request $peticion, Tasks $Tasks)
    {
        $datos = $this->validar($peticion);

        $Tasks->update($datos);

        return redirect()->route('Taskss.index')->with('exito', 'Tarea actualizada.');
    }

    public function destroy(Tasks $Tasks)
    {
        $Tasks->delete();

        return redirect()->route('Taskss.index')->with('exito', 'Tarea eliminada.');
    }

    public function changeStatus(Request $peticion, Tasks $Tasks)
    {
        $datos = $peticion->validate(
            ['estado' => 'required|in:por_hacer,en_curso,hecha'],
            ['estado.required' => 'El estado es obligatorio.', 'estado.in' => 'El estado no es válido.']
        );

        $Tasks->update($datos);

        return redirect()->route('Taskss.index')->with('exito', 'Estado actualizado.');
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