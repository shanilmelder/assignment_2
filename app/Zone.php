<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'is_active', 'market_price', 'admin_fee', 'tax_rate'
    ];
}
