<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAuthCode(Request $request)
    {
        if (!$request->has('mac')) {
            return TextResponse('not mac address');
//            return response('')->header('Content-Type', 'text/plain');
        }
        $token = 'auth:for:device:' . md5($request->mac);
        return TextResponse($token);
    }

    public function updates(Request $request)
    {
        if (!$request->has('auth_code')) {
            return TextResponse('auth_code is required');
        }

        if (Cache::has('direction_changed') && Cache::get('direction_changed')) {
            $power = 0;
            $direction = 0;
            $pump1 = 0;
            $pump2 = 0;
            $speed = 0;
        } else {
            $power = Cache::get('power') == 'on' ? 1 : 0;
            $direction = Cache::get('direction') == 'forward' ? 1 : 2;
            $pump1 = Cache::get('pump1') == 'on' ? 1 : 0;
            $pump2 = Cache::get('pump2') == 'on' ? 1 : 0;
            $speed = Cache::get('speed');
        }


        $str = $power . ',' . $direction . ',' . $pump1 . ',' . $pump2 . ',' . $speed;
        return TextResponse($str);
    }
}
