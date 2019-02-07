<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon',
    ];

    public function voucher()
    {
        return $this->hasOne('App\Voucher');
    }

}
