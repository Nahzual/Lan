<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Lan;
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
  				return back()->with('error','You can\'t add an activity to a LAN you are not an admin of.');
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
  				return back()->with('error','You can\'t add an activity to a LAN you are not an admin of.');
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
			$lan=Lan::find($lanId);
			if($lan!=null){
				$activity=$lan->activities()->find($activityId);
				if($activity!=null){
					if(Auth::check()){
						$userIsLanAdmin=Auth::user()->lans()->where('lan_user.lan_id','=',$lanId)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
						return view('activity.show', compact('lan', 'activity','userIsLanAdmin'));
					}else{
						return view('activity.show', compact('lan', 'activity'));
					}
				}else{
					return back()->with('error','This activity doesn\'t exist.');
				}
			}else{
				return back()->with('error','This LAN doesn\'t exist.');
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
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit an activity if you are not an admin of its LAN.');
  			}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$activity = $lan->activities()->find($activityId);
						if($activity == null){
							return back()->with('error','This activity doesn\'t exist.');
						}else{
							return view('activity.edit', compact('lan', 'activity'));
						}
					}else{
						return back()->with('error','This LAN doesn\'t exist.');
					}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s activity.');
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
					return view('activity.edit', compact('lan', 'activity'));
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
				}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }
}
