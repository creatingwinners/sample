<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'name',
        'short',
        'type',
        'quantity',
        'actie_id',
        'coupon',
    ];

    public function vouchers()
    {
        return $this->hasMany('App\Voucher');
    }

    public function actie()
    {
        return $this->belongsTo('App\Actie');
    }
}
