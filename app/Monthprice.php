<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monthprice extends Model
{
    protected $fillable = [
        'voucher_id',
        'start',
        'end',
    ];

    public function voucher()
    {
        return $this->belongsTo('App\Voucher');
    }

    public function acties()
    {
        return $this->belongsToMany('App\Actie');
    }

}
