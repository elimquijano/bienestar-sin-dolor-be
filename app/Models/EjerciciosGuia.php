<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjerciciosGuia extends Model
{
    use HasFactory;
    protected $fillable = ['sesion_guia_id', 'nombre', 'descripcion', 'url_animacion_fbx'];
}
