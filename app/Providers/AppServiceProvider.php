<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

use App\Actie;
use App\Voucher;
use App\Coupon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
        if(Schema::hasTable('acties')) {
            $global_acties = Actie::orderBy('name', 'asc')->get();
            View::share('global_acties', $global_acties);
        }
     }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
