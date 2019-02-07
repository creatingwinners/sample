<?php

use Illuminate\Database\Seeder;

use App\Price;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3; $i++) {
            Price::create([
                'name' => 'Price 1',
                'short' => 'One',
                'type' => 'day',
                'quantity' => 1,
                'actie_id' => $i + 1,
            ]);
            Price::create([
                'name' => 'Price 2',
                'short' => 'Two',
                'type' => 'day',
                'quantity' => 1,
                'actie_id' => $i + 1,
            ]);
            Price::create([
                'name' => 'Price 3',
                'short' => 'Three',
                'type' => 'day',
                'quantity' => 10,
                'actie_id' => $i + 1,
                'coupon' => 'book',
            ]);
            Price::create([
                'name' => 'Price 4',
                'short' => 'Four',
                'type' => 'day',
                'quantity' => 10,
                'actie_id' => $i + 1,
                'coupon' => 'diner',
            ]);
            Price::create([
                'name' => 'Price 5',
                'short' => 'Five',
                'type' => 'month',
                'quantity' => 1,
                'actie_id' => $i + 1,
            ]);
        }

    }
}
