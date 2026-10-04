<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categorias";

    protected $fillable = ["nombre"];

    public function recipe()
    {
        return $this->hasMany(Recipe::class, 'categoriaId', 'id');
    }
}
