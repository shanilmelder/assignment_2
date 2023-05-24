<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnergyType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'is_active', 'market_price', 'admin_fee', 'tax_rate'
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
