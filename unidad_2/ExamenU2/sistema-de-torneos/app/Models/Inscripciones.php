<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'torneo_id'])]
class Inscripciones extends Model
{
    protected $table = "inscripciones";

    protected $casts = [
        "user_id"=> "integer",
        "torneo-id"=> "integer",
    ] ;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }
}
