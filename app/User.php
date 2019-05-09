<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
            return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    static function actualizar($user, $userSocial){
        $update = $user;
        $update->name =  $userSocial->name;
        $update->avatar = $userSocial->avatar;
        $update->save();
    }

    public function certificados(){
        return $this->hasMany('App\Model\Tecnico\TecnicoDocument');
    }
}
