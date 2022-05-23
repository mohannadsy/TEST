<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewUserData;


class UserController extends Controller
{
    //
    public function index()
    {
        $users = ViewUserData::select("*")
            ->get()
            ->toArray();

        dd($users);
    }
}
