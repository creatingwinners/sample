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

use Mail;
use App\Mail\PriceMail;

class VoucherController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:supervisor|administrator']);
    }

    public function index()
    {
        return view('admin.voucher.index');
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
        ->leftJoin('acties', 'vouchers.actie_id','=','acties.id')
        ->leftJoin('prices', 'vouchers.price_id','=','prices.id')
        ->leftJoin('coupons', 'vouchers.coupon_id','=','coupons.id')
        ->leftJoin('participants', 'vouchers.participant_id','=','participants.id');
        return DataTables::of($vouchers)->make(true);
    }

    public function index_actie(Actie $actie)
    {
        return view('admin.voucher.index', [
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
        ->leftJoin('acties', 'vouchers.actie_id','=','acties.id')
        ->leftJoin('prices', 'vouchers.price_id','=','prices.id')
        ->leftJoin('coupons', 'vouchers.coupon_id','=','coupons.id')
        ->leftJoin('participants', 'vouchers.participant_id','=','participants.id');
        return DataTables::of($vouchers)->make(true);
    }

    public function details($voucher)
    {
        return Voucher::where('id', $voucher)->with('actie')->with('price')->with('coupon')->with('participant')->first();
    }

    public function mail(Voucher $voucher)
    {
        Mail::to($voucher->participant->email)->send(new PriceMail($voucher));
        return 1;
    }

}
