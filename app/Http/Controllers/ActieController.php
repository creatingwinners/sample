<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\VoucherVerifyRequest;


use App\Actie;
use App\Voucher;
use Carbon\Carbon;


class ActieController extends Controller
{

    public function winner(Actie $actie)
    {
        $voucher = session('voucher');
        return view('actie.winner', [
            'actie' => $actie,
            'voucher' => Voucher::find($voucher),
        ]);
    }

    public function chance(Actie $actie)
    {
        return view('actie.chance', ['actie' => $actie]);
    }

    public function inactive(Actie $actie)
    {
        return view('actie.inactive', ['actie' => $actie]);
    }

    public function processed(Actie $actie)
    {
        return view('actie.chance', ['actie' => $actie]);
    }

}
