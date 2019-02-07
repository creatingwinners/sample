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

class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:supervisor|administrator']);
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.coupon.index');
    }

    public function data()
    {
        $coupons = Coupon::select(
            'coupons.id',
            'coupons.coupon',
            'coupons.type',
            'vouchers.code',
            'vouchers.updated_at'
        )
        ->leftJoin('vouchers', 'vouchers.coupon_id','=','coupons.id');

        return DataTables::of($coupons)->make(true);
    }

    public function details(Coupon $coupon)
    {
        return $coupon;
    }

}
