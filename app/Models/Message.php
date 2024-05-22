<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Message extends Authenticatable // Extiende la clase Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    protected $fillable = ['description', 'id_incidence', 'id_department', 'id_aula', 'user', 'estado','fecha_creacion'];

}

