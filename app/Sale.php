<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function energyType(){
        return $this->belongsTo('App\EnergyType');
    }
}
