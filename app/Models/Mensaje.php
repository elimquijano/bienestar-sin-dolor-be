<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = ['conversation_id', 'user_id', 'content', 'is_read'];
    use HasFactory;
}
