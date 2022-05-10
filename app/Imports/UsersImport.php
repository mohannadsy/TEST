<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


//HeadingRowFormatter::default('none');


class UsersImport implements ToModel ,WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'name'  => $row['name'],
            'email' => $row['email'],

            'password' => Hash::make($row['password']),
        ]);
    }
//    public function headingRow()
//    {
//        return 2;
//    }
}
