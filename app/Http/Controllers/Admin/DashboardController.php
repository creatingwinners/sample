<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Actie;
use App\Voucher;
use App\Log;
use App\Price;
use App\Coupon;
use App\Participant;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $acties = Actie::orderBy('name', 'asc')->where('active', 1)->where('start_at', '<=', date('Y-m-d'))->where('end_at', '>=', date('Y-m-d'))->get();
        $today_wins  = [];
        $total_vouchers = [];
        $today_vouchers = [];

        foreach($acties AS $actie) {
            $today_vouchers[$actie->id] = $actie->vouchers()
            ->whereDate('updated_at', '=', date('Y-m-d'))
            ->whereHas('participant')
            ->count();

            $total_vouchers[$actie->id] = $actie
            ->vouchers()
            ->whereHas('participant')
            ->count();

            foreach($actie->prices AS $price) {
                $today_wins[$price->id] = $price
                ->vouchers()
                ->whereDate('updated_at', '=', date('Y-m-d'))
                ->count();
            }
        }

        return view('admin.dashboard.index', [
            'acties' => $acties,
            'today_wins' => $today_wins,
            'total_vouchers' => $total_vouchers,
            'today_vouchers' => $today_vouchers,
        ]);

    }

    public function test(Request $request)
    {

        $voucher = Voucher::where('code', $request->code)->first();
        return view('mails.helaas', [
            'voucher' => $voucher,
        ]);

        $voucher = Voucher::where('code', $request->code)->first();
        $log = Log::where('ipaddress', $voucher->ipaddress)
        ->where('created_at', '>', Carbon::now()->subHour(12))
        ->get();

        return [
            Carbon::now()->subHour($voucher->actie->ip_limit_duration),
            $voucher->actie->ip_limit,
            $log,
        ];
    }
}

?>
