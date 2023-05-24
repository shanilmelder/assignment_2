<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolumeHistory extends Model
{

    public function energyType(){
        return $this->belongsTo('App\EnergyType');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}