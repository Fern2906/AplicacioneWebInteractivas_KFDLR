<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class JugadorController extends Controller
{
    public function index(): View
    {
        $inscripciones = auth()->user()
            ->inscripciones()
            ->with('torneo')
            ->get();

        return view('MisTorneos', compact('inscripciones'));
    }
}
