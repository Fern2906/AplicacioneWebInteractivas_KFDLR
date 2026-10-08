<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripciones;

#[Fillable(['nombre', 'juego', 'fecha_futura', 'cupo', 'descripcion', 'estado'])]
class Torneo extends Model
{
    protected $table = 'torneos';

    protected $casts = [
        'fecha_futura' => 'datetime',
        'cupo' => 'integer',
        'estado' => 'boolean',
    ];

    public function inscripciones()
    {
        return $this->hasMany(Inscripciones::class, 'torneo_id');
    }

    public function estaVencida(): bool
    {
        return $this->fecha_futura && $this->fecha_futura->isPast();
    }
}
