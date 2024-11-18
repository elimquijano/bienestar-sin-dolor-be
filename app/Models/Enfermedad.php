<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;
    protected $fillable = ['categoria_id', 'nombre', 'image', 'etiquetas', 'descripcion', 'duracion_base'];

    public function sintomas()
    {
        return $this->belongsToMany(Sintoma::class, 'enfermedad_sintomas');
    }
}
