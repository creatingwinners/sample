<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Voucher;
use App\Coupon;
use App\Price;
use App\Actie;
use App\Participant;

class WinnerController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:supervisor|administrator']);
    }

    public function index()
    {
        return view('admin.winner.index');
    }

    public function data()
    {
        $vouchers = Voucher::select(
            'vouchers.*',
            'acties.name',
            'participants.email',
            'prices.short',
            'prices.coupon AS price_has_coupon',
            'coupons.coupon'
        )
        ->whereNotNull('vouchers.price_id')
        ->leftJoin('acties', 'vouchers.actie_id','=','acties.id')
        ->leftJoin('prices', 'vouchers.price_id','=','prices.id')
        ->leftJoin('coupons', 'vouchers.coupon_id','=','coupons.id')
        ->leftJoin('participants', 'vouchers.participant_id','=','participants.id');

        return DataTables::of($vouchers)->make(true);
    }

    public function index_actie(Actie $actie)
    {
        return view('admin.winner.index', [
            'actie' => $actie,
        ]);
    }

    public function data_actie(Actie $actie)
    {
        $vouchers = Voucher::select(
            'vouchers.*',
            'acties.name',
            'participants.email',
            'prices.short',
            'prices.coupon AS price_has_coupon',
            'coupons.coupon'
        )
        ->where('vouchers.actie_id', $actie->id)
        ->whereNotNull('vouchers.price_id')
        ->leftJoin('acties', 'vouchers.actie_id','=','acties.id')
        ->leftJoin('prices', 'vouchers.price_id','=','prices.id')
        ->leftJoin('coupons', 'vouchers.coupon_id','=','coupons.id')
        ->leftJoin('participants', 'vouchers.participant_id','=','participants.id');

        return DataTables::of($vouchers)->make(true);
    }

}
