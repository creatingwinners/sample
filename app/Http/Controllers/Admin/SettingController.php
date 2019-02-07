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

use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:supervisor|administrator']);
    }

    public function index(Actie $actie)
    {
        $min = [];
        foreach($actie->prices AS $price) {
            $min[$price->id] = Voucher::whereHas('price', function($query) use ($price) {
                return $query->where('id', $price->id);
            })->whereDate('updated_at', Carbon::today())->count();
        }

        return view('admin.setting.index', [
            'actie' => $actie,
            'min' => $min,
        ]);
    }

    public function update(SettingRequest $request, Actie $actie)
    {
        $actie->update([
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'ratio_win' => $request->ratio_win,
            'ip_limit' => $request->ip_limit,
            'ip_limit_duration' => $request->ip_limit_duration,
        ]);
        if(isset($request->quantity)) {
            if(is_array($request->quantity)) {
                foreach($request->quantity AS $price_id => $quantity) {
                    $price = Price::find($price_id);
                    if($price) {
                        if($quantity >= 0) {
                            $price->update([
                                'quantity' => $quantity
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->route('dashboard.index');
    }

}
