<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleManager = Role::create(['name' => 'Manager']);
        $roleOwner = Role::create(['name' => 'Owner']);
        $roleUser = Role::create(['name' => 'User']);
        //-----give permissions to Admin Role-----//
        $roleAdmin->givePermissionTo('store-user');
        $roleAdmin->givePermissionTo('update-user');
        $roleAdmin->givePermissionTo('delete-user');
        $roleAdmin->givePermissionTo('show-user');
        $roleAdmin->givePermissionTo('store-role');
        $roleAdmin->givePermissionTo('update-role');
        $roleAdmin->givePermissionTo('show-role');
        $roleAdmin->givePermissionTo('delete-role');
        $roleAdmin->givePermissionTo('show-permission');
        $roleAdmin->givePermissionTo('store-permission');
        $roleAdmin->givePermissionTo('update-permission');
        $roleAdmin->givePermissionTo('delete-permission');
        $roleAdmin->givePermissionTo('show-permission');
        //-----give permissions to Manager Role-----//
        $roleManager->givePermissionTo('store-role');
        $roleManager->givePermissionTo('update-role');
        $roleManager->givePermissionTo('delete-role');
        $roleManager->givePermissionTo('show-role');
        //-----give permissions to Owner Role-----//
        $roleOwner->givePermissionTo('store-user');
        $roleOwner->givePermissionTo('update-user');
        $roleOwner->givePermissionTo('delete-user');
        $roleOwner->givePermissionTo('show-user');
        //-----give permissions to User Role-----//
        $roleUser->givePermissionTo('delete-user');
        $roleUser->givePermissionTo('delete-role');
        $roleUser->givePermissionTo('delete-permission');
    }
}
