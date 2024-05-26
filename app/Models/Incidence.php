<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Importa la clase Model

class Incidence extends Model // Extiende la clase Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'incidences';

    protected $fillable = [
        'id',
        'description',
    ];
}
