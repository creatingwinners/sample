<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Voucher;
use Hashids;

class PriceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voucher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        switch($this->voucher->price->id) {
            case 1:
            case 6:
            case 11:
                // fuel
                return $this->subject('Action - congratulations!')->view('mails.fuel');
            break;
            case 2:
            case 7:
            case 12:
                // card
                return $this->subject('Action - congratulations!')->view('mails.card');
            break;
            case 3:
            case 8:
            case 13:
                // book
                return $this->subject('Action - congratulations!')->view('mails.book');
            break;
            case 4:
            case 9:
            case 14:
                // dinner
                return $this->subject('Action - congratulations!')->view('mails.dinner');
            break;
            case 5:
            case 10:
            case 15:
                // scooter
                return $this->subject('Action - congratulations!')->view('mails.scooter');
            break;
        }
    }
}
