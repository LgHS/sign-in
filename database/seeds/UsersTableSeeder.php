<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();

        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@lghs.be';
        $user->password = Hash::make('admin');
        $user->is_active = true;
        $user->uuid = Uuid::generate();
        $user->save();
        $user->attachRole($adminRole);
    }
}
