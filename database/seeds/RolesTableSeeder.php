<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'member_active']);
        Role::create(['name' => 'member_effective']);
        Role::create(['name' => 'member_old']);
        Role::create(['name' => 'member_honorary']);
    }
}