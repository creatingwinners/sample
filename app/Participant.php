<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'email',
    ];

    public function vouchers()
    {
        return $this->hasMany('App\Voucher');
    }
}
