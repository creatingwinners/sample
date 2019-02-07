<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\VoucherVerifyRequest;
use App\Http\Requests\VoucherAddressRequest;

use App\Actie;
use App\Voucher;
use App\Log;
use App\Price;
use App\Coupon;
use App\Participant;
use Carbon\Carbon;

use Mail;
use App\Mail\PriceMail;
use App\Mail\HelaasMail;
use Hashids;

class VoucherController extends Controller
{

    public function reset(Request $request, $actie)
    {
        // $vouchers = Voucher::whereHas('actie', function($query) use ($actie) {
        //     $query->where('id', $actie);
        // })->update([
        //     'price_id' => null,
        //     'participant_id' => null,
        //     'coupon_id' => null,
        // ]);
        // return redirect()->route('voucher.test');
    }

    public function test(Request $request)
    {
        $log = Log::where('ipaddress', $request->getClientIp())->where('created_at', '>', Carbon::now()->subHour(1))->get();
        $vouchers = Voucher::doesntHave('participant')
        // ->where('actie_id', 1)
        ->inRandomOrder()
        ->take(20)
        ->get();

        $acties = Actie::all();
        $used = [];
        $info = [];
        foreach($acties AS $actie) {

            $prices = Price::whereHas('actie', function($query) use ($actie) {
                return $query->where('actie_id', $actie->id);
            })->where('type', 'day')->get();

            $info[$actie->id][] = $actie;
            $info[$actie->id][] = Voucher::whereDate('updated_at', Carbon::today())
                ->whereHas('actie', function($query) use ($actie) {
                    $query->where('id', $actie->id);
                })
                ->has('participant')
                ->count();

            foreach($prices AS $price) {
                $info[$actie->id][] = Voucher::whereDate('updated_at', Carbon::today())
                    ->whereHas('actie', function($query) use ($actie) {
                        $query->where('id', $actie->id);
                    })
                    ->whereHas('price', function($query) use ($actie, $price) {
                        $query->where('id', $price->id)->where('actie_id', $actie->id);
                    })
                    ->has('participant')
                    ->count();
            }
            $info[$actie->id][] = $prices;
        }

        $prices_available = Price::where('type', 'day')->whereHas('actie', function($query) {
            $query->where('id', 2);
        })->get();

        $prices_given = Voucher::whereHas('actie', function ($query) {
            $query->where('id', 2);
        })->whereDate('updated_at', Carbon::today())->has('price')->get();


        return view('voucher.test', [
            'vouchers' => $vouchers,
            'log' => $log,
            'info' => $info
        ]);
    }

    public function welcome(Request $request)
    {
        return view('voucher.welcome');
    }

    public function code(Request $request)
    {
        return view('voucher.code');
    }

    public function verify(VoucherVerifyRequest $request)
    {
        // Log ip address
        Log::create(['ipaddress' => $request->getClientIp()]);

        // Try get voucher
        $voucher = Voucher::where('code', $request->code)->first();

        // Valid voucher?
        if(!$voucher) {
            return route('voucher.oeps');
        }

        // Actie voucher?
        if(!$voucher->actie->active) {
            return route('actie.inactive', [$voucher->actie->id]);
        } else {
            if($voucher->actie->start_at > date('Y-m-d') || $voucher->actie->end_at < date('Y-m-d')) {
                return route('actie.inactive', [$voucher->actie->id]);
            }
        }

        // Used voucher?
        if($voucher->participant !== null) {
            return route('voucher.oeps');
        }

        // Store voucher as used
        $participant = Participant::firstOrCreate(['email' => strtolower($request->email)]);
        $voucher->participant()->associate($participant)->save();

        $voucher->update([
            'ipaddress' => $request->getClientIp(),
        ]);
        $voucher->save();

        // Reached IP limit / hour?
        $log = Log::where('ipaddress', $request->getClientIp())->where('created_at', '>', Carbon::now()->subDays($voucher->actie->ip_limit_duration));
        if($log->count() > $voucher->actie->ip_limit) {
            Mail::to($request->email)->send(new HelaasMail($voucher));
            return route('actie.chance', ['actie' => $voucher->actie->id]);
        }

        // x-th particpant
        if(Voucher::whereDate('updated_at', Carbon::today())->whereHas('actie', function($query) use ($voucher) {
            $query->where('id', $voucher->actie->id);
        })->has('participant')->count() % $voucher->actie->ratio_win == 0) {

            // Prices available
            $prices_available = Price::where('type', 'day')->whereHas('actie', function($query) use ($voucher) {
                $query->where('id', $voucher->actie->id);
            })->get();

            // Prices given
            $prices_given = Voucher::whereHas('actie', function ($query) use ($voucher) {
                $query->where('id', $voucher->actie->id);
            })->whereDate('updated_at', Carbon::today())->has('price')->get();

            if($prices_available->sum('quantity') > $prices_given->count()) {
                $available = [];
                foreach($prices_available AS $price) {
                    $given = Voucher::whereDate('updated_at', Carbon::today())
                    ->whereHas('actie', function($query) use ($voucher) {
                        $query->where('id', $voucher->actie->id);
                    })
                    ->whereHas('price', function($query) use ($price) {
                        $query->where('id', $price->id);
                    })
                    ->has('participant')
                    ->get();
                    if($price->quantity - $given->count() > 0) {
                        for($i = 0; $i < $price->quantity - $given->count(); $i++) {
                            $available[] = $price->id;
                        }
                    }
                }
                if(count($available) > 0) {
                    $random = array_rand($available, 1);
                    $voucher->price()->associate($available[$random])->save();

                    $check = Price::find($available[$random]);
                    if($check->coupon !== null) {
                        $coupon = Coupon::where('type', $check->coupon)
                                    ->doesntHave('voucher')
                                    ->inRandomOrder()
                                    ->first();
                        $voucher->coupon()->associate($coupon)->save();
                    }

                    Mail::to($request->email)->send(new PriceMail($voucher));

                    return route('actie.winner', ['actie' => $voucher->actie->id]);
                }
            }
        }

        // Mail::to($request->email)->send(new HelaasMail($voucher));

        Mail::to($request->email)->send(new HelaasMail($voucher));
        return route('actie.chance', ['actie' => $voucher->actie->id]);
    }

    public function oeps(Request $request)
    {
        return view('voucher.oeps');
    }

    public function invalid()
    {
        return view('voucher.invalid');
    }

    public function address(Request $request, $hash)
    {
        $id = Hashids::decode($hash);
        if(!$id) {
            return view('voucher.oeps');
        }

        $voucher = Voucher::where('id', $id)->first();
        if(!$voucher) {
            return view('voucher.oeps');
        }

        return view('voucher.address', [
            'voucher' => $voucher
        ]);
    }

    public function save(VoucherAddressRequest $request)
    {
        $id = Hashids::decode($request->hash);
        if(!$id) {
            return view('voucher.oeps');
        }

        $voucher = Voucher::where('id', $id)->first();
        if(!$voucher) {
            return view('voucher.oeps');
        }

        $voucher->timestamps = false;
        $voucher->update([
            'cardnumber' => !empty($request->cardnumber) ? $request->cardnumber : null,
            'naam' => $request->naam,
            'adres' => $request->adres,
            'huisnummer' => $request->huisnummer,
            'postcode' => $request->postcode,
            'woonplaats' => $request->woonplaats,
        ]);

        return route('voucher.saved');

    }

    public function saved()
    {
        return view('voucher.saved');
    }

}
