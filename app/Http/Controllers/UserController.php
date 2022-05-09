<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserIp(Request $request)
    {
        return $user_ip_address=$request->ip();

//        Request::ip();
    }

    public function userDevice()
    {

    }
}
