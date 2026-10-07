<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CreateTournament');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string'],
            'fecha_futura' => ['required', 'date', 'after:now'],
            'cupo' => ['required', 'integer', 'min:2', 'max:100'],
            'estado' => ['required', 'in:0,1'],
            'juego' => ['required', 'string'],
            'descripcion'=> ['string'],
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

            'descripcion'=> 'La descripcion debe ser texto',
        ]);

        Torneo::create($data);

        return redirect()->route('dashboard')->with('success', 'Torneo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Torneo $torneo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Torneo $torneo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Torneo $torneo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Torneo $torneo)
    {
        //
    }
}
