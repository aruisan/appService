<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyImagen extends Model
{
    protected $table = 'emergency_imagen';

    protected $fillable = ['url', 'emergency_id'];
}
