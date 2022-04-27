<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $userMohannad = User::create([
        //     'name' => 'Mohannad Mahmoud',
        //     'email' => 'mohannad@gmail.com',
        //     'password' => bcrypt('12345mohannad'),
        // ]);
        $role = Role::create([
            'name' => 'User'
        ]);
        
        $userMohannad = User::find(1);
        $userMohannad->assignRole('User');
    }
}
