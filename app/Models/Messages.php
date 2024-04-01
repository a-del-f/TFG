<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Messages extends Authenticatable // Extiende la clase Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'id_incidence',
        'seen',
        'solved'
    ];
}

