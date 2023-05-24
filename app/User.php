<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'address1', 'address2', 'city', 'state', 'postcode', 'country', 'email', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sales(){
        return $this->hasMany('App\Sales');
    }

    public function purchases(){
        return $this->hasMany('App\Purchase');
    }

    public function volumeHistory(){
        return $this->hasMany('App\VolumeHistory');
    }
}
