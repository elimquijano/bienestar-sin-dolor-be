<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionesGuia extends Model
{
    use HasFactory;
    protected $fillable = ['tratamiento_guia_id', 'descripcion'];
}
