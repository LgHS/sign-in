<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageAccount = new Permission();
        $manageAccount->name = 'manage-account';
        $manageAccount->save();

        $manageMembers = new Permission();
        $manageMembers->name = 'manage-members';
        $manageMembers->save();

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->attachPermissions([$manageAccount, $manageMembers]);

        $memberHonorary = Role::where('name', 'member_honorary')->first();
        $memberActive = Role::where('name', 'member_active')->first();
        $memberEffective = Role::where('name', 'member_effective')->first();
        $memberOld = Role::where('name', 'member_old')->first();

        $memberHonorary->attachPermission($manageAccount);
        $memberActive->attachPermission($manageAccount);
        $memberEffective->attachPermission($manageAccount);
        $memberOld->attachPermission($manageAccount);


        /*
         *  member_old
            member_honorary
            member_active
            membe
         */
    }
}
