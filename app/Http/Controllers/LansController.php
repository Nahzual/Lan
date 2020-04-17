<?php

namespace App\Http\Controllers;

use App\Lan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		    $user = Auth::user();
        $lans = $user->lans;

        if($user->rank_user==1){
          $waiting_lans = Lan::where('waiting_lan','=','1')->get();

          return view('dashboard.admin.index', compact('lans', 'user','waiting_lans'));
        }
        else return view('dashboard.index', compact('lans', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$lan = new Lan();
		$lan->name = $request->name;
		$lan->max_num_registrants = $request->max_num_registrants;
		$lan->opening_date = $request->opening_date;
		$lan->duration = $request->duration;
		$lan->budget = $request->budget;
		$lan->save();

		$lan->users()->attach(Auth::user()->id, ['rank_lan' => 1, 'score_lan' => 0]);

		return response()->json([
		'success'=>'Votre Lan a été correctement enregistrée'
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if(Auth::check()){
        $lan = Lan::findOrFail($id);
        return view('lan.show', compact('lan'));
      }else{
        return redirect('/home');
      }
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
      $user=Auth::user();
      if($user->lans()->findOrFail($id)==null && $user->rank!=1){
        return redirect('/home');
      }else{
        $lan = Lan::findOrFail($id);
        return view('lan.edit', compact('lan'));
      }
    }else{
      return redirect('/home');
    }

		return view('lan.edit', compact('lan'));
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

      if(Auth::check()){
        $user=Auth::user();
        if($user->lans()->findOrFail($id)==null && $user->rank!=1){
          return redirect('/home');
        }else{
          $lan = Lan::findOrFail($id);
          $lan->update($request->all());
          $lan->save();

          return redirect(route('lan.show', $id));
        }
      }else{
        return redirect('/home');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$lan = Auth::user()->lans()->findOrFail($id);

		//Supprime le bateau
		$lan->delete();
		return redirect(route('lan.index'));
    }
}
