<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    // use Notifiable;
    protected $table = 'personas';
    public $timestamps = false;
    protected $fillable = [
        'numeroide'
    ];

    protected $guarded = [];
 
}
