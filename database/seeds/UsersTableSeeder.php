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

        if(!env('ADMIN_USERNAME') || !env('ADMIN_EMAIL') || !env('ADMIN_PASSWORD')) {
            throw new Exception('Please define ADMIN_USERNAME, ADMIN_EMAIL and ADMIN_PASSWORD in your .env file');
        }

        $user = new User();
        $user->username = env('ADMIN_USERNAME');
        $user->email = env('ADMIN_EMAIL');
        $user->password = Hash::make(env('ADMIN_PASSWORD'));
        $user->is_active = true;
        $user->uuid = Uuid::generate();
        $user->save();
        $user->attachRole($adminRole);
    }
}
