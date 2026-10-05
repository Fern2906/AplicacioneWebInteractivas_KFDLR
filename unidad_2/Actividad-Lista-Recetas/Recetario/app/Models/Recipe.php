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
        'usuario_id',
        'categoria_id',
        'dificultad_id'
    ];

    public function  usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Category::class, 'categoria_id', 'id');
    }

    public function dificultad()
    {
        return $this->belongsTo(Dificult::class, 'dificultad_id', 'id');
    }
}
