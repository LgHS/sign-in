<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class TestUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();

        $user = factory(User::class)->make();
        $user->email = 'test@example.com';
        $user->password = Hash::make('test123');
        $user->is_active = true;
        $user->uuid = Uuid::generate();
        $user->save();
        $user->attachRole($adminRole);
    }
}
