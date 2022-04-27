<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //---------------users--------------------------//
        $storeUser = Permission::create(['name' => 'store-user']);
        $updateUser = Permission::create(['name' => 'update-user']);
        $deleteUser = Permission::create(['name' => 'delete-user']);
        $showUser = Permission::create(['name' => 'show-user']);
        //---------------roles--------------------------//
        $storeRole = Permission::create(['name' => 'store-role']);
        $updateRole = Permission::create(['name' => 'update-role']);
        $deleteRole = Permission::create(['name' => 'delete-role']);
        $showRole = Permission::create(['name' => 'show-role']);
        //---------------permissions--------------------------//
        $storePermission = Permission::create(['name' => 'store-permission']);
        $updatePermission = Permission::create(['name' => 'update-permission']);
        $deletePermission = Permission::create(['name' => 'delete-permission']);
        $showPermission = Permission::create(['name' => 'show-permission']);

    }
}
