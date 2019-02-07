<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            ActiesTableSeeder::class,
            PricesTableSeeder::class,
            CouponsTableSeeder::class,
            VouchersTableSeeder::class,
        ]);
    }
}
