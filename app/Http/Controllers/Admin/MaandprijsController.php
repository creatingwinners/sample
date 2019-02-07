<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Actie;
use App\Voucher;
use App\Log;
use App\Price;
use App\Coupon;
use App\Participant;
use App\Monthprice;
use Carbon\Carbon;

use App\Http\Requests\SettingRequest;

class MaandprijsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:supervisor|administrator']);
    }

    public function index()
    {
        $prices = Monthprice::orderBy('created_at')->get();

        return view('admin.maandprijs.index', [
            'prices' => $prices,
        ]);
    }

    public function search()
    {

        $acties = Actie::orderBy('name', 'asc')->get();

        return view('admin.maandprijs.search', [
            'acties' => $acties,
        ]);
    }

    public function select(Request $request)
    {

        $contender = Voucher::select('participant_id')
        ->whereIn('actie_id', $request->actie)
        ->where('updated_at', '>=', $request->start)
        ->where('updated_at', '<=', $request->end)
        // ->whereNotNull('naam')
        ->whereNotNull('participant_id')
        ->groupBy('participant_id')
        ->inRandomOrder()
        ->first();

        $participant = Participant::find($contender->participant_id);

        $win_voucher = Voucher::where('participant_id', $contender->participant_id)
        ->whereIn('actie_id', $request->actie)
        ->where('updated_at', '>=', $request->start)
        ->where('updated_at', '<=', $request->end)
        ->with('price')
        ->with('actie')
        ->inRandomOrder()
        ->first();

        $all_vouchers = Voucher::where('participant_id', $contender->participant_id)
        ->whereIn('actie_id', $request->actie)
        ->where('updated_at', '>=', $request->start)
        ->where('updated_at', '<=', $request->end)
        ->with('price')
        ->with('actie')
        ->orderBy('updated_at', 'desc')
        ->get();

        $contender_ipaddresses = Voucher::where('participant_id', $contender->participant_id)
        ->select('ipaddress')
        ->whereIn('actie_id', $request->actie)
        ->where('updated_at', '>=', $request->start)
        ->where('updated_at', '<=', $request->end)
        ->orderBy('updated_at', 'desc')
        ->get();

        $contender_prices = Voucher::where('participant_id', $contender->participant_id)
        ->whereHas('price')
        ->with('price')
        ->with('actie')
        ->orderBy('updated_at', 'desc')
        ->get();

        $log = Log::whereIn('ipaddress', $contender_ipaddresses)
        ->where('created_at', '>=', $request->start)
        ->where('created_at', '<=', $request->end)
        ->get();

        $other_participants = Voucher::where('participant_id', '!=', $contender->participant_id)
        ->whereIn('actie_id', $request->actie)
        ->whereIn('ipaddress', $contender_ipaddresses)
        ->where('updated_at', '>=', $request->start)
        ->where('updated_at', '<=', $request->end)
        ->orderBy('updated_at', 'desc')
        ->with('participant')
        ->with('price')
        ->with('actie')
        ->get();

        return [
            'participant' => $participant,
            'win_voucher' => $win_voucher,
            'all_vouchers' => $all_vouchers,
            'contender_ipaddresses' => $contender_ipaddresses,
            'contender_prices' => $contender_prices,
            'log' => $log,
            'other_participants' => $other_participants,
        ];
    }

    public function save(Request $request)
    {
        $mp = Monthprice::create([
            'voucher_id' => $request->winner,
            'start' => $request->start,
            'end' => $request->end,
        ]);
        $mp->acties()->attach($request->actie);
        return redirect()->route('maandprijs.index');
    }


}
