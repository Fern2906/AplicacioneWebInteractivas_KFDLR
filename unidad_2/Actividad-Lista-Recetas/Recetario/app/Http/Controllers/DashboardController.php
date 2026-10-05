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
            // Asegura que siempre se maneje como un arreglo, ya sea uno o varios valores
            $categoriasFiltro = is_array($request->categoria_id) 
                ? $request->categoria_id 
                : [$request->categoria_id];
            
            $query->whereIn('categoria_id', $categoriasFiltro);
        }

        if ($request->filled('dificultad_id')) {
            $dificultadesFiltro = is_array($request->dificultad_id) 
                ? $request->dificultad_id 
                : [$request->dificultad_id];
            
            $query->whereIn('dificultad_id', $dificultadesFiltro);
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
