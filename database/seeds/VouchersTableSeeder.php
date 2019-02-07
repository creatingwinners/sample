<?php

use Illuminate\Database\Seeder;

use App\Voucher;
use App\Actie;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 1000; $i++) {
            $actie = Actie::inRandomOrder()->first();
            Voucher::create([
                'code' => str_random(12),
                'actie_id' => $actie->id,
            ]);
        }
    }
}
