<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $rememberTokenName = null;

    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
    ];

    protected $appends = [
        'name',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'contrasena' => 'hashed',
        ];
    }

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthPassword(): string
    {
        return $this->contrasena;
    }

    public function getNameAttribute(): string
    {
        return $this->nombre;
    }

    public function getEmailAttribute(): string
    {
        return $this->correo;
    }
}
