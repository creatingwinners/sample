<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'administrator', 'guard_name' => 'web']);
        Role::create(['name' => 'supervisor', 'guard_name' => 'web']);

        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        $super = User::create([
            'name' => 'Supervisor',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
        ]);

        $admin->assignRole('administrator');
        $super->assignRole('supervisor');
    }
}
