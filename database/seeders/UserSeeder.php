<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userMohannad = User::create([
            'name' => 'Mohannad Mahmoud',
            'email' => 'mohannad@gmail.com',
            'password' => bcrypt('12345mohannad'),
        ]);
        $userMohannad->assignRole('User');

        $userNoor = User::create([
            'name' => 'Noor Al-kinj',
            'email' => 'noor@gmail.com',
            'password' => bcrypt('12345noor'),
        ]);
        $userNoor->assignRole('Manager');


        $userClauda = User::create([
            'name' => 'Clauda Al-Rakkad',
            'email' => 'clauda@gmail.com',
            'password' => bcrypt('12345clauda'),
        ]);
        $userClauda->assignRole('Admin');

        $userSara = User::create([
            'name' => 'Sara Abdo',
            'email' => 'sara@gmail.com',
            'password' => bcrypt('12345sara'),
        ]);
        $userSara->assignRole('Owner');

        $userRaghad = User::create([
            'name' => 'Raghad Naanou',
            'email' => 'raghad@gmail.com',
            'password' => bcrypt('12345raghad'),
        ]);
        $userRaghad->givePermissionTo('show-user');
        $userRaghad->givePermissionTo('show-role');
        $userRaghad->givePermissionTo('show-permission');
















//
//        $role = Role::create(['name' => 'high_Admin']);
//
//        $permissions = Permission::pluck('id', 'id')->all();
//
//        $role->syncPermissions($permissions);
//
//        $user->assignRole([$role->id]);
    }
}
