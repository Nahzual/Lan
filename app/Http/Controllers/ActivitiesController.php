<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Lan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lanId)
    {
			if(Auth::check()){
				$user=Auth::user();
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lans.id')->find($lanId)==null && !$user->isSiteAdmin()){
  				return back()->with('error','You can\'t add an activity to a LAN you are not an admin of.');
  			}else{
					$lan=Lan::find($lanId);
					if($lan!=null){
						return view('activity.create', compact('lan'));
					}else{
						return back()->with('error','This LAN doesn\'t exist.');
					}
  			}
  		}else{
  			return redirect('/login')->with('error','Please log in to perform this action.');
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
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lans.id')->find($lanId)==null && !$user->isSiteAdmin()){
  				return response()->json(['error'=>'You can\'t add an activity to a LAN you are not an admin of.']);
  			}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$activity = new Activity();
						$activity->name_activity = htmlentities($request->name_activity);
						$activity->desc_activity = htmlentities($request->desc_activity);
						$activity->lan()->associate($lan->id);
						$activity->save();

						return response()->json([
							'success'=>'Your Activity has been saved successfully.'
						]);
					}else{
						return response()->json(['error'=>'This LAN doesn\'t exist.']);
					}
  			}
  		}else{
  			return response()->json(['error'=>'You must be logged in to edit a LAN.']);
  		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lanId, $activityId){
			$lan=Lan::find($lanId);
			if($lan!=null){
				$activity=$lan->activities()->find($activityId);
				if($activity!=null){
					if(Auth::check()){
						$user=Auth::user();
						$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lan_user.lan_id','=',$lanId)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lans.id')->first()!=null;
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
    public function edit($lanId, $activityId){
			if(Auth::check()){
				$user=Auth::user();
	  		if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lans.id')->find($lanId)==null && !$user->isSiteAdmin()){
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
    public function update(Request $request, $lanId, $activityId){
			if(Auth::check()){
				$user=Auth::user();
	  		if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lans.id')->find($lanId)==null && !$user->isSiteAdmin()){
	  			return response()->json(['error'=>'You can\'t edit an activity if you are not an admin of its LAN.']);
	  		}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$activity = $lan->activities()->find($activityId);
						if($activity == null){
							return response()->json(['error'=>'This activity doesn\'t exist.']);
						}else{
							$activity->name_activity=htmlentities($request->name_activity);
							$activity->desc_activity=htmlentities($request->desc_activity);
							$activity->save();
							return response()->json(['success'=>'The activity "'.$activity->name_activity.'" has been successfully edited.']);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lanId, $activityId)
    {
      if(Auth::check()){
				$user=Auth::user();
				if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lans.id')->find($lanId)==null && !$user->isSiteAdmin()){
	  			return response()->json(['error'=>'You can\'t delete an activity if you are not an admin of its LAN.']);
  			}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$activity = $lan->activities()->find($activityId);
						if($activity == null){
							return response()->json(['error'=>'This activity doesn\'t exist.']);
						}else{
							$activity->delete();
							return response()->json(['success'=>'This activity has been successfully deleted.']);
						}
					}else{
						return response()->json(['error'=>'This LAN doesn\'t exist.']);
					}
	  		}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to delete a LAN\'s activity.');
  		}
    }
}
