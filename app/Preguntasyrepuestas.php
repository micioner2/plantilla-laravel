<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntasyrepuestas extends Model
{
    protected $table = 'preguntasyrespuestas';
    protected $fillable = ["idpregunta","respuesta","idalumno"];
    public $timestamps = false;
    protected $guarded = ['id'];
}
