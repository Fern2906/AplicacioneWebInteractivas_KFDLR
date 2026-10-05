<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Dificult;
use App\Models\Recipe;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categorias   = Category::select('id', 'nombre')->orderBy('nombre')->get();
        $dificultades = Dificult::select('id', 'nombre')->orderBy('id')->get();

        $query = Recipe::with(['categoria', 'dificultad'])
            ->where('usuario_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('dificultad_id')) {
            $query->where('dificultad_id', $request->dificultad_id);
        }

        $recetas = $query->orderBy('created_at', 'desc')->get();

        return Inertia::render('dashboard', [
            'categorias'   => $categorias,
            'dificultades' => $dificultades,
            'recetas'      => $recetas,
            'filters'      => $request->only(['search', 'categoria_id', 'dificultad_id']),
        ]);
    }
}
