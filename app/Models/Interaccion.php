<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    protected $table = 'interacciones';
    protected $fillable = ['conversation_id', 'user_id', 'pregunta', 'respuesta'];
    use HasFactory;
}
