<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Message extends Model // Extiende la clase Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'messages';

    protected $fillable = ['description', 'id_incidence', 'id_department', 'id_aula', 'user', 'estado','id_message','fecha_creacion'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'id_department');
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }

}

