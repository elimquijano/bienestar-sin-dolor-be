<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    protected $fillable = ['name', 'image', 'email', 'phone', 'address', 'location'];
    use HasFactory;
}
