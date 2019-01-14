<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuentas';

    protected $fillable = [
        'user_id', 'banco_id','tipo_cuenta', 'cuenta',
    ];
}
