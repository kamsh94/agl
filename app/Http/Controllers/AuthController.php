<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if (!$request->has('mac')){
            return TextResponse('not mac address');
//            return response('')->header('Content-Type', 'text/plain');
        }
        $token = 'auth:for:device:'.md5($request->mac);
        return TextResponse($token);
    }

    public function updates(Request $request)
    {
        if (!$request->has('auth_code')){
            return TextResponse('auth_code is required');
        }
        $str = rand(0,1).','.rand(0,1).','.rand(0,1).','.rand(0,1).','.rand(0,100).'%';
        return TextResponse($str);
    }
}
