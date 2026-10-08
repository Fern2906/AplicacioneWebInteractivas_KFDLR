<?php

namespace App\Http\Controllers;

use App\Models\Inscripciones;
use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function store(Request $request, Torneo $torneo): RedirectResponse
    {
        $user = auth()->user();

        if ($torneo->inscripciones()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Ya estás inscrito en este torneo.');
        }

        if (! $torneo->estado) {
            return back()->with('error', 'Este torneo está cerrado.');
        }

        if ($torneo->fecha_futura->isPast()) {
            return back()->with('error', 'La fecha de este torneo ya ha pasado.');
        }

        if ($torneo->inscripciones()->count() >= $torneo->cupo) {
            return back()->with('error', 'Este torneo ya no tiene cupo disponible.');
        }

        Inscripciones::create([
            'user_id' => $user->id,
            'torneo_id' => $torneo->id,
        ]);

        return back()->with('success', 'Te has inscrito al torneo exitosamente.');
    }

    public function destroy(Inscripciones $inscripciones): RedirectResponse
    {
        $user = auth()->user();
        $isAdmin = $user->rol === 'administrador';

        if (! $isAdmin && $inscripciones->user_id !== $user->id) {
            return back()->with('error', 'No tienes permisos para cancelar esta inscripción.');
        }

        if (! $isAdmin && $inscripciones->torneo->fecha_futura->isPast()) {
            return back()->with('error', 'No puedes cancelar la inscripción de un torneo que ya ha comenzado.');
        }

        $inscripciones->delete();

        return back()->with('success', 'Inscripción cancelada exitosamente.');
    }
}
