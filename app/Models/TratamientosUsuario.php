<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TratamientosUsuario extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'tratamiento_guia_id', 'fecha_inicio', 'fecha_fin', 'progreso_total', 'estado'];
}
