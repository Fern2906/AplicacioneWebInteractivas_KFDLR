<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nombre', 'juego_id', 'fecha_futura', 'cupo', 'descripcion', 'estado'])]
class Torneo extends Model
{
    protected $table = "torneos";

    protected $casts = [
        "fecha_futura"=> "datetime",
        "cupo"=> "integer",
        "juego_id" => "integer",
        "estado"=> "boolean",
    ];

    public function estaVencida() : bool
    {
        return $this->fecha_futura && $this->fecha_futura->isPast();
    }
}
