<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonederoMovimiento extends Model
{
    protected $table = 'monedero_movimientos';

    protected $fillable = ['valor', 'monedero_id' , 'cliente_id', 'state'];
}
