<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionUsuario extends Model
{
    use HasFactory;
    protected $fillable = ['tratamiento_usuario_id', 'sesion_guia_id', 'fecha', 'progreso_sesion'];
}
