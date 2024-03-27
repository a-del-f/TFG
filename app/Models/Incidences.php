<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Importa la clase Model

class Incidences extends Authenticatable // Extiende la clase Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
    ];
}
