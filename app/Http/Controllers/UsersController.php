<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	   public function store(Request $request){

    		return response()->json([
    		    'success'=>'Votre Lan a été correctement enregistrée'
    		]);
      }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
  		if(Auth::check()){
  				return view('user.edit');
  		}else{
  			return redirect('/home');
  		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        return response()->json(['error'=>'Veuillez vous connecter pour réaliser cette action']);

    }

    /**
     * Display a listing of the resource fitting the Request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      $helpers=User::where('pseudo','LIKE',$request->pseudo)->get();
      $lan=Lan::where('id','=',$request->lan_id)->first();
      return view('user.helper.show_add',compact('helpers','lan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		return redirect(route('user.index'));
    }
}
