<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lanId)
    {
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a LAN for which you are not an admin.');
  			}else{
				$lan = $user->lans()->find($lanId);
  				return view('activity.create', compact('lan'));
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lanId)
    {
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a LAN for which you are not an admin.');
  			}else{
				$lan = $user->lans()->find($lanId);
  				$activity = new Activity();
				$activity->name_activity = $request->name_activity;
				$activity->desc_activity = $request->desc_activity;
				$activity->lan()->associate($lan->id);
				$activity->save();

				return response()->json([
					'success'=>'Your Activity has been saved successfully.'
				]);
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
		if($user->rank_user >= 1){
			$activity = Activity::findOrFail($id);
			return view('activity.show', compact('activity'));
		}else{
			$lans = user()->lans;
			foreach($lans as $lan){
				$activity = $lan->activities()->find($id);
				if(isset($activity)){
					return view('activity.show', compact('activity'));
				}
			}
		}
		return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
		if($user->rank_user >= 1){
			$activity = Activity::findOrFail($id);
			return view('activity.edot', compact('activity'));
		}else{
			$lans = user()->lans;
			foreach($lans as $lan){
				$activity = $lan->activities()->find($id);
				if(isset($activity)){
					return view('activity.edit', compact('activity'));
				}
			}
		}
		return view('home');
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
        $user = Auth::user();
		if($user->rank_user >= 1){
			$activity = Activity::findOrFail($id);
			$activity->update($request->all());
			$activity->save();
			return view('activity.edit', compact('activity'));
		}else{
			$lans = user()->lans;
			foreach($lans as $lan){
				$activity = $lan->activities()->find($id);
				if(isset($activity)){
					$activity->update($request->all());
					$activity->save();
					return view('activity.edit', compact('activity'));
				}
			}
		}
		return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
