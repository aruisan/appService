<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = ['user_id', 'dia', 'hh_init','hh_end'];
}
