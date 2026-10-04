<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dificult extends Model
{
    protected $table = "dificultades";

    protected $fillable = ["nombre"];

    public function recipe()
    {
        return $this->hasMany(Recipe::class, 'dificultadId', 'id');
    }
}
