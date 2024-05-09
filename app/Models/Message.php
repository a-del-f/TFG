<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Message extends Authenticatable // Extiende la clase Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'messages';

    protected $fillable = ['description', 'id_incidence', 'id_department', 'id_aula', 'user', 'estado','id_message','fecha_creacion'];

}

