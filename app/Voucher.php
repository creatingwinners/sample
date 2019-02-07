<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'actie_id',
        'cardnumber',
        'naam',
        'adres',
        'huisnummer',
        'postcode',
        'woonplaats',
        'ipaddress',

    ];

    public function actie()
    {
        return $this->belongsTo('App\Actie');
    }

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    public function price()
    {
        return $this->belongsTo('App\Price');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Coupon');
    }


}
