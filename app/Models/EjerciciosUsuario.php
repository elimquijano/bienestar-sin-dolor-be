<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjerciciosUsuario extends Model
{
    use HasFactory;
    protected $fillable = ['sesion_usuario_id', 'ejercicio_guia_id', 'progreso_ejercicio', 'estado'];
}
