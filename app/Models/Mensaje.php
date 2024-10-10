<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = ['conversation_id', 'user_id', 'content', 'is_read'];
    use HasFactory;
    // Definir la relación con la conversación
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    // Definir la relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function conversations()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }
}
