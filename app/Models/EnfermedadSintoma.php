<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnfermedadSintoma extends Model
{
    use HasFactory;
    protected $fillable = ['enfermedad_id', 'sintoma_id'];
}
