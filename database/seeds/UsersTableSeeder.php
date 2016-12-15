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
//        $user->is_valid = true;
        $user->is_active = true;
//        $user->token_valid = str_random(60);
        $user->uuid = Uuid::generate();
        $user->save();
        $user->attachRole($adminRole);
    }
}
