<?php

namespace App\Model\Tecnico;

use Illuminate\Database\Eloquent\Model;

class TecnicoDocument extends Model
{
    protected $fillable = ['documento', 'certificado', 'user_id'];
}
