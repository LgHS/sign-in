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
        Role::create(['name' => 'admin', 'display_name' => 'Administrateur']);
        Role::create(['name' => 'member_active', 'display_name' => 'Membre actif']);
        Role::create(['name' => 'member_effective', 'display_name' => 'Membre effectif']);
        Role::create(['name' => 'member_old', 'display_name' => 'Ancien membre']);
        Role::create(['name' => 'member_honorary', 'display_name' => 'Membre d\'honneur']);
    }
}