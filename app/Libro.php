<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table='libro';
    public $timestamps = false;
    protected $fillable = [
        'ISBN', 'titulo', 'editorial', 'precio_general', 'precio_estudiante'
    ];
}

