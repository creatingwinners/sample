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

class DownloadController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:supervisor|administrator']);
    }

    public function index()
    {
        return view('admin.download.index');
    }

    public function download($file)
    {
        return response()->download(storage_path('app/downloads/'.$file));
    }

}
