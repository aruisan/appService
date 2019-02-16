<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transacciones';

    protected $fillable = ['user_id', 'fecha' , 'transaccion_id', 'transaccion_message', 'amount', 'pse_bank', ' pse_cycle', 'reference_pol'];
}
