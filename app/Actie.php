<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actie extends Model
{
    protected $fillable = [
        'start_at',
        'end_at',
        'active',
        'name',
        'ip_limit',
        'ip_limit_duration',
        'ratio_win',
    ];

    public function vouchers()
    {
        return $this->hasMany('App\Voucher');
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }

}
