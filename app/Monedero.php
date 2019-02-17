<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monedero extends Model
{
    protected $table = 'monederos';

    protected $fillable = ['stock', 'user_id'];
}
