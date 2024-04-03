<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Messages extends Authenticatable // Extiende la clase Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_incidence',
        "description",
        'seen',
        'solved'
    ];
}

