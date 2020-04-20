<?php

namespace App\Http\Controllers;

use App\Lan;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home(Request $request){
        $lans = Lan::where('waiting_lan','=',0)->where('opening_date','>',date('Y-m-d'));

        // lan research based on location
        if(isset($request->location)){
          $user=User::where('users.id','=',Auth::user()->id)
                    ->join('locations','users.location_id','=','locations.id')
                    ->join('streets','locations.street_id','=','streets.id')
                    ->join('cities','streets.city_id','=','cities.id')
                    ->join('departments','cities.department_id','=','departments.id')
                    ->join('countries','departments.country_id','=','countries.id')
                    ->select('users.id as userID','locations.id as locationID','streets.id as streetID','cities.id as cityID','departments.id as depID','countries.id as countryID')->first();

          $lans=$lans->join('locations','lans.location_id','=','locations.id');

          switch($request->location){
             case 'country': $lans=$lans->join('streets','locations.street_id','=','streets.id')
                                         ->join('cities','streets.city_id','=','cities.id')
                                         ->join('departments','cities.department_id','=','departments.id')
                                         ->join('countries','departments.country_id','=','countries.id')
                                         ->where('countries.id','=',$user->countryID); break;

             case 'department': $lans=$lans->join('streets','locations.street_id','=','streets.id')
                                          ->join('cities','streets.city_id','=','cities.id')
                                          ->join('departments','cities.department_id','=','departments.id')
                                          ->where('departments.id','=',$user->depID); break;

             case 'city': $lans=$lans->join('streets','locations.street_id','=','streets.id')
                                     ->join('cities','streets.city_id','=','cities.id')
                                     ->where('cities.id','=',$user->cityID); break;
             default: break;
          }

        }

        // lan research based on opening date
        if(isset($request->date1) && isset($request->date2)){
          $lans=$lans->where('lans.opening_date','>=',$request->date1)->where('lans.opening_date','<=',$request->date2);
        }

        $lans=$lans->get();


        if(isset($request->date1) && isset($request->date2) && isset($request->location)) return view('home', compact('lans'))->with(['location'=>$request->location,'date1'=>$request->date1,'date2'=>$request->date2]);
        else if(isset($request->date1) && isset($request->date2)) return view('home', compact('lans'))->with(['date1'=>$request->date1,'date2'=>$request->date2]);
        else if(isset($request->date1) && isset($request->location)) return view('home', compact('lans'))->with(['location'=>$request->location,'date1'=>$request->date1]);
        else if(isset($request->date2) && isset($request->location)) return view('home', compact('lans'))->with(['location'=>$request->location,'date2'=>$request->date2]);
        else if(isset($request->date1)) return view('home', compact('lans'))->with(['date1'=>$request->date1]);
        else if(isset($request->date2)) return view('home', compact('lans'))->with(['date2'=>$request->date2]);
        else if(isset($request->location)) return view('home', compact('lans'))->with(['location'=>$request->location]);
        else return view('home', compact('lans'));

    }

    public function contact()
    {
	return view('contact');
    }
}
