<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = auth()->user();
        $isAdmin = $user && $user->rol === 'administrador';

        if (! $isAdmin) {
            $data = Torneo::withCount('inscripciones')
                ->where('estado', true)
                ->where('fecha_futura', '>', now())
                ->orderBy('fecha_futura', 'asc')
                ->get()
                ->filter(fn ($torneo) => $torneo->inscripciones_count < $torneo->cupo)
                ->values();
        } else {
            $data = Torneo::withCount('inscripciones')->get();
        }

        if ($user) {
            $userInscripcionIds = $user->inscripciones()->pluck('torneo_id')->toArray();
            $data = $data->map(function ($torneo) use ($userInscripcionIds) {
                $torneo->ya_inscrito = in_array($torneo->id, $userInscripcionIds);

                return $torneo;
            });
        } else {
            $data = $data->map(function ($torneo) {
                $torneo->ya_inscrito = false;

                return $torneo;
            });
        }

        return view('Dashboard', compact('data'));
    }
}
