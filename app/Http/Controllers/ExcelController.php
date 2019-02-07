<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actie;
use App\Voucher;
use App\Log;
use App\Price;
use App\Coupon;
use App\Participant;
use Carbon\Carbon;
use Storage;

use App\Exports\WinnerExport;
use App\Exports\ParticipantExport;
use Excel;

class ExcelController extends Controller
{
    public function winners()
    {

        $acties = Actie::whereDate('start_at', '<=', date('Y-m-d'))
        ->whereDate('end_at', '>=', date('Y-m-d'))
        ->get();

        foreach($acties AS $actie) {
            $export = [];
            $winners = Voucher::has('price')
            ->has('participant')
            ->whereHas('actie', function ($query) use ($actie) {
                return $query->where('id', $actie->id);
            })
            ->orderBy('updated_at', 'desc')
            ->get();

            if($winners) {
                $datum = false;
                foreach($winners AS $winner) {
                    $export[] = [
                        $winner->code,
                        $winner->price->short,
                        isset($winner->coupon->coupon) ? $winner->coupon->coupon : '',
                        $winner->participant->email,
                        isset($winner->naam) ? $winner->naam : '',
                        isset($winner->adres) ? $winner->adres : '',
                        isset($winner->huisnummer) ? $winner->huisnummer : '',
                        isset($winner->postcode) ? $winner->postcode : '',
                        isset($winner->woonplaats) ? $winner->woonplaats : '',
                        Carbon::createFromFormat('Y-m-d H:i:s', $winner->updated_at)->format('Y-m-d H:i:s'),
                    ];
                }
            }
            Excel::store(new WinnerExport(collect($export)), 'downloads/winners-'.str_replace(' ', '-', strtolower($actie->name)).'.xlsx');
        }
        return 1;
    }

    public function participants()
    {

        $acties = Actie::whereDate('start_at', '<=', date('Y-m-d'))
        ->whereDate('end_at', '>=', date('Y-m-d'))
        ->get();

        foreach($acties AS $actie) {
            $export = [];
            $participants = Voucher::has('participant')
            ->whereHas('actie', function ($query) use ($actie) {
                return $query->where('id', $actie->id);
            })
            ->orderBy('updated_at', 'desc')
            ->get();

            if($participants) {
                $datum = false;
                foreach($participants AS $participant) {
                    $export[] = [
                        $participant->code,
                        isset($participant->price->short) ? $participant->price->short : '',
                        isset($participant->coupon->coupon) ? $participant->coupon->coupon : '',
                        $participant->participant->email,
                        isset($participant->naam) ? $participant->naam : '',
                        isset($participant->adres) ? $participant->adres : '',
                        isset($participant->huisnummer) ? $participant->huisnummer : '',
                        isset($participant->postcode) ? $participant->postcode : '',
                        isset($participant->woonplaats) ? $participant->woonplaats : '',
                        isset($participant->ipaddress) ? $participant->ipaddress : '',
                        Carbon::createFromFormat('Y-m-d H:i:s', $participant->updated_at)->format('Y-m-d H:i:s'),
                    ];
                }
            }
            Excel::store(new ParticipantExport(collect($export)), 'downloads/participants-'.str_replace(' ', '-', strtolower($actie->name)).'.xlsx');
        }
        return 1;
    }
}
