<?php

namespace App\Http\Controllers;

use App\Lan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lans = Lan::where('waiting_lan','=',0)->where('opening_date','>',date('Y-m-d'))->get();

		    return view('home', compact('lans'));
    }
}
