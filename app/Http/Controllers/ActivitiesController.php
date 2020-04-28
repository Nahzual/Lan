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
    public function show($lanId, $activityId)
    {	
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
  			}else{
				$lan = $user->lans()->find($lanId);
				$activity = $lan->activities()->find($activityId);
				if($activity == null){
					return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
				}else{
					return view('activity.show', compact('lan', 'activity'));
				}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lanId, $activityId)
    {	
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
  			}else{
				$lan = $user->lans()->find($lanId);
				$activity = $lan->activities()->find($activityId);
				if($activity == null){
					return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
				}else{
					return view('activity.edit', compact('lan', 'activity'));
				}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lanId, $activityId)
    {	
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
  			}else{
				$lan = $user->lans()->find($lanId);
				$activity = $lan->activities()->find($activityId);
				if($activity == null){
					return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
				}else{
					$activity->update($request->all());
					$activity->save();
					return response()->json(['success'=>'The activity "'.$activity->name_activity.'" has been successfully edited.']);
				}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lanId, $activityId)
    {
        if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
  			}else{
				$lan = $user->lans()->find($lanId);
				$activity = $lan->activities()->find($activityId);
				if($activity == null){
					return back()->with('error','You can\'t edit a Activity for which you are not an admin.');
				}else{
					$activity->delete();
					return response()->json(['success'=>'This activity has been successfully deleted.']);
				}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }
}
