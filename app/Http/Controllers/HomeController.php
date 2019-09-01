<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
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

    public function index()
    {
        return view('home');
    }

    public function saveDump(Request $request)
    {
        foreach ($request->all() as $k => $v) {
            echo $k .' : '.$v."<br/>";
            Cache::put($k, $v);
        }
        echo "<h1>Saved</h1>";
        echo "<a href=".url('/home')." class='btn'>Back</a>";
    }


}
