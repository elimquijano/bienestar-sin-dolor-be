<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FramesGuia extends Model
{
    use HasFactory;
    protected $fillable = ['guia_ejercicio_id', 'numero_frame', 'coordenadas'];
}
