<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Dificult;

class DashboardController extends Controller
{
    public function index()
    {
        $categorias = Category::select('id', 'nombre')
            ->orderBy('nombre')
            ->get();

        $dificultades = Dificult::select('id', 'nombre')
            ->orderBy('id')
            ->get();

        return Inertia::render("dashboard", 
        ['categorias' => $categorias,
         'dificultades'=> $dificultades]);
    }
}
