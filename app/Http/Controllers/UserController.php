<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserIp(Request $request)
    {
        return $user_ip_address = $request->ip();
        // or :  $user_ip_address = \Request::ip();

    }

    public function userDevice()
    {
        $agent = new \Jenssegers\Agent\Agent;

        //  $platform = $agent->platform(); // operating system


        if ($agent->isMobile()) {    // Mobile State
            return 'Mobile';
        } elseif ($agent->isDesktop()) {   //Desktop State  : Windows or Linux
            if ($agent->is('Windows')) {
                return 'Windows';
            } elseif ($agent->is('Linux')) {
                return 'Linux';
            } else {
                return '';
            }
        } else {
            return 'Tablet';  // Other State : for example  Tablet
        }


    }
}
