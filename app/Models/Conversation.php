<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['tipo_id'];
    use HasFactory;
    // Definir la relación con los participantes
    public function participante()
    {
        return $this->hasMany(Participante::class);
    }

    // Definir la relación con los mensajes
    public function mensaje()
    {
        return $this->hasMany(Mensaje::class);
    }
    public function participantes()
    {
        return $this->belongsToMany(User::class, 'participantes', 'conversation_id', 'user_id');
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'conversation_id');
    }
}
