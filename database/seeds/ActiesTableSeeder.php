<?php

use Illuminate\Database\Seeder;

use App\Actie;

class ActiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actie::create([
            'active' => true,
            'name' => 'Action 1',
            'start_at' => '2019-01-01',
            'end_at' => '2019-03-01',
        ]);
        Actie::create([
            'active' => true,
            'name' => 'Action 2',
            'start_at' => '2019-01-07',
            'end_at' => '2019-03-07',
        ]);
        Actie::create([
            'active' => true,
            'name' => 'Action 3',
            'start_at' => '2019-02-05',
            'end_at' => '2019-04-05',
        ]);
    }
}
