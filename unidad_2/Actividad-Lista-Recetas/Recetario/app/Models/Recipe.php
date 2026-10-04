<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = "recetas";

    protected $fillable = [
        'titulo',
        'tiempo',
        'ingredientes',
        'pasos',
        'nota',
        'imagen',
        'categoriaId',
        'dificultadId'
    ];

    public function categoria()
    {
        return $this->belongsTo(Category::class, 'categoriaId', 'id');
    }

    public function dificultad()
    {
        return $this->belongsTo(Dificult::class, 'dificultadId', 'id');
    }
}
