<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Aula extends Model
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'id_department',
        'name'


    ];
    protected $table = 'aula';
    public function department()
    {
        return $this->belongsTo(Department::class, 'id_department');
    }


}
