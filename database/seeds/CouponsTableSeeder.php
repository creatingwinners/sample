<?php

use Illuminate\Database\Seeder;

use App\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'book',
            'diner',
        ];
        for($i = 0; $i < 200; $i++) {
            $k = array_rand($array);
            Coupon::create([
                'coupon' => str_random(8),
                'type' => $array[$k],
            ]);
        }
    }
}
