<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Dificult;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $categorias   = Category::select('id', 'nombre')->orderBy('nombre')->get();
        $dificultades = Dificult::select('id', 'nombre')->orderBy('id')->get();

        return Inertia::render('createRecipe', [
            'categorias'   => $categorias,
            'dificultades' => $dificultades,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'       => 'required|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'dificultad_id'=> 'required|integer|exists:dificultades,id',
            'tiempo'       => 'required|integer|min:1',
            'pasos'        => 'required|string',
            'ingredientes' => 'required|string',
            'nota'         => 'nullable|string',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('recetas', 'public');
        }

        $validated['usuario_id'] = auth()->id();

        Recipe::create($validated);

        return redirect()->route('dashboard')->with('success', '¡Receta creada con éxito!');
    }

    public function show(string $id)
    {
        $receta = Recipe::with(['categoria', 'dificultad'])
            ->where('usuario_id', auth()->id())
            ->findOrFail($id);

        return Inertia::render('recipeDetail', [
            'receta' => $receta,
        ]);
    }

    public function edit(string $id)
    {
        $receta = Recipe::where('usuario_id', auth()->id())->findOrFail($id);

        $categorias   = Category::select('id', 'nombre')->orderBy('nombre')->get();
        $dificultades = Dificult::select('id', 'nombre')->orderBy('id')->get();

        return Inertia::render('editRecipe', [
            'receta'       => $receta,
            'categorias'   => $categorias,
            'dificultades' => $dificultades,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $receta = Recipe::where('usuario_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'titulo'       => 'required|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'dificultad_id'=> 'required|integer|exists:dificultades,id',
            'tiempo'       => 'required|integer|min:1',
            'pasos'        => 'required|string',
            'ingredientes' => 'required|string',
            'nota'         => 'nullable|string',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($receta->imagen) {
                Storage::disk('public')->delete($receta->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('recetas', 'public');
        }

        $receta->update($validated);

        return redirect()->route('dashboard')->with('success', '¡Receta actualizada con éxito!');
    }

    public function destroy(string $id)
    {
        $receta = Recipe::where('usuario_id', auth()->id())->findOrFail($id);

        if ($receta->imagen) {
            Storage::disk('public')->delete($receta->imagen);
        }

        $receta->delete();

        return redirect()->route('dashboard')->with('success', 'Receta eliminada.');
    }
}
