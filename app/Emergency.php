<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    protected $table = 'emergency';

    protected $fillable = ['description', 'type_emergency', 'category_emergency','lat','lng', 'user_id','especialista_id'];


    public function emergencyImages(){
        return $this->hasMany('App\EmergencyImagen');
    }    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
