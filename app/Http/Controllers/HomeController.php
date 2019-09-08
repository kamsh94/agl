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
        $this->validate($request, [
            'power' => 'required',
            'direction' => 'required',
            'pump1' => 'required',
            'pump2' => 'required',
            'speed' => 'required',
        ]);
        if ($request->has('direction') and $request->direction != Cache::get('direction')) {
            Cache::put('direction_changed',1,6);
        }
        foreach ($request->all() as $k => $v) {
            echo $k . ' : ' . $v . "<br/>";
            Cache::forever($k, $v);
        }
       return redirect('home');
        echo "<h2><a href=" . url('/home/') . " class='btn'>Back</a></h2>";
    }
    public function dashboard(){
        return view('dashboard');
    }


}
