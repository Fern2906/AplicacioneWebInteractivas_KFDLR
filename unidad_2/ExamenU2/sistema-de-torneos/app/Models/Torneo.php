<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $table = "torneos";

    protected $fillable = [
        "nombre",
        "juego",
        "fecha_futura",
        "cupo",
        "descripcion",
        "estado",
    ] ;

    protected $casts = [
        "fecha_futura"=> "datetime",
        "cupo"=> "integer",
        "estado"=> "boolean",
    ];

    public function estaVencida() : bool
    {
        return $this->fecha_futura && $this->fecha_futura->isPast();
    }
}
