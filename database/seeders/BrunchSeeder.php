<?php

namespace Database\Seeders;

use App\Models\Brunch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrunchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brunch::create([
            'name' => 'first Brunch',
            'position' => 'country1'
        ]);
        Brunch::create([
            'name' => 'second Brunch',
            'position' => 'country1'
        ]);
    }
}
