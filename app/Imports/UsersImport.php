<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


//HeadingRowFormatter::default('none');


class UsersImport implements ToModel
{

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'name'  => $row[1],
            'email' => $row[2],

            'password' => Hash::make($row[3]),
        ]);
    }
//    public function headingRow()
//    {
//        return 2;
//    }
}
