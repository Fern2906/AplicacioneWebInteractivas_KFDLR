<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|RedirectResponse
    {
        if (auth()->user()->rol !== 'administrador') {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        return view('TournamentForm');
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->rol !== 'administrador') {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $data = $request->validate([
            'nombre' => ['required', 'string'],
            'fecha_futura' => ['required', 'date', 'after:now'],
            'cupo' => ['required', 'integer', 'min:2', 'max:100'],
            'estado' => ['required', 'in:0,1'],
            'juego' => ['required', 'string'],
            'descripcion' => ['nullable', 'string'],
        ], [
            'nombre.required' => 'Es necesario el nombre para el torneo',

            'fecha_futura.required' => 'La fecha del torneo es necesaria',
            'fecha_futura.after' => 'La fecha del torneo debe ser posterior a la fecha actual.',

            'cupo.required' => 'El cupo es necesario',
            'cupo.min' => 'El cupo mínimo es de al menos 2 jugadores',
            'cupo.max' => 'El cupo máximo es de 100 jugadores',

            'estado.required' => 'El estado del torneo es necesario',
            'estado.in' => 'El estado seleccionado no es válido',

            'juego.required' => 'Es necesario que escribas un juego',

            'descripcion' => 'La descripcion debe ser texto',
        ]);

        Torneo::create($data);

        return redirect()->route('dashboard')->with('success', 'Torneo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Torneo $torneo): View
    {
        $torneo->load('inscripciones.user');

        return view('TorneoDetail', ['torneo' => $torneo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Torneo $torneo): View|RedirectResponse
    {
        if (auth()->user()->rol !== 'administrador') {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $torneo->load('inscripciones.user');

        return view('TournamentForm', ['torneo' => $torneo, 'inscritos' => $torneo->inscripciones]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Torneo $torneo): RedirectResponse
    {
        if (auth()->user()->rol !== 'administrador') {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $data = $request->validate([
            'nombre' => ['required', 'string'],
            'fecha_futura' => ['required', 'date', 'after:now'],
            'cupo' => ['required', 'integer', 'min:2', 'max:100'],
            'estado' => ['required', 'in:0,1'],
            'juego' => ['required', 'string'],
            'descripcion' => ['nullable', 'string'],
        ], [
            'nombre.required' => 'Es necesario el nombre para el torneo',

            'fecha_futura.required' => 'La fecha del torneo es necesaria',
            'fecha_futura.after' => 'La fecha del torneo debe ser posterior a la fecha actual.',

            'cupo.required' => 'El cupo es necesario',
            'cupo.min' => 'El cupo mínimo es de al menos 2 jugadores',
            'cupo.max' => 'El cupo máximo es de 100 jugadores',

            'estado.required' => 'El estado del torneo es necesario',
            'estado.in' => 'El estado seleccionado no es válido',

            'juego.required' => 'Es necesario que escribas un juego',

            'descripcion' => 'La descripcion debe ser texto',
        ]);

        $currentCount = $torneo->inscripciones()->count();
        if ((int) $data['cupo'] < $currentCount) {
            return back()->withErrors(['cupo' => "El cupo no puede ser menor al número de inscritos actuales ({$currentCount})."]);
        }

        $torneo->update($data);

        return redirect()->route('dashboard')->with('success', 'Torneo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Torneo $torneo): RedirectResponse
    {
        if (auth()->user()->rol !== 'administrador') {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $torneo->delete();

        return redirect()->route('dashboard')->with('success', 'Torneo eliminado exitosamente.');
    }
}
