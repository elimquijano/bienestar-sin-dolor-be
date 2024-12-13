<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TratamientosGuia extends Model
{
    use HasFactory;
    protected $fillable = ['enfermedad_id', 'descripcion'];
}
