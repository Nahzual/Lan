<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TasksController extends Controller
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
  			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_HELPER')){
  				return back()->with('error','You can\'t add a task to a LAN you are not an admin of.');
  			}else{
				$lan = $user->lans()->find($lanId);
  				return view('task.create', compact('lan'));
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
  				return back()->with('error','You can\'t add a task to a LAN you are not an admin of.');
  			}else{
				$lan = $user->lans()->find($lanId);
  				$task = new Task();
				$activity->name_task = $request->name_task;
				$activity->desc_task = $request->desc_task;
				$activity->deadline_task = $request->deadline_task;
				$activity->lan()->associate($lan->id);
				$activity->save();

				return response()->json([
					'success'=>'Your Task has been saved successfully.'
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
    public function show($lanId, $taskId)
    {
			$lan=Lan::find($lanId);
			if($lan!=null){
				$task=$lan->tasks()->find($taskId);
				if($task!=null){
					if(Auth::check()){
						$userIsLanAdmin=Auth::user()->lans()->where('lan_user.lan_id','=',$lanId)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
						return view('task.show', compact('lan', 'task','userIsLanAdmin'));
					}else{
						return view('task.show', compact('lan', 'task'));
					}
				}else{
					return back()->with('error','This task doesn\'t exist.');
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
    public function edit($lanId, $taskId)
    {
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a task if you are not an admin of its LAN.');
  			}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$task = $lan->activities()->find($taskId);
						if($task == null){
							return back()->with('error','This task doesn\'t exist.');
						}else{
							return view('task.edit', compact('lan', 'task'));
						}
					}else{
						return back()->with('error','This LAN doesn\'t exist.');
					}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s task.');
  		}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lanId, $taskId)
    {
			if(Auth::check()){
	  		$user=Auth::user();
	  		if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
	  			return response()->json(['error'=>'You can\'t edit a task if you are not an admin of its LAN.']);
	  		}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$task = $lan->tasks()->find($taskId);
						if($task == null){
							return response()->json(['error'=>'This task doesn\'t exist.']);
						}else{
							$task->update($request->all());
							$task->save();
							return response()->json(['success'=>'The task "'.$task->name_task.'" has been successfully edited.']);
						}
					}else{
						return back()->with('error','This LAN doesn\'t exist.');
					}
	  		}
	  	}else{
	  		return redirect('/login')->with('error','You must be logged in to edit a LAN\'s task.');
	  	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lanId, $taskId)
    {
      if(Auth::check()){
  			$user=Auth::user();
				if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
	  			return response()->json(['error'=>'You can\'t delete a task if you are not an admin of its LAN.']);
  			}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$task = $lan->tasks()->find($taskId);
						if($atask == null){
							return response()->json(['error'=>'This task doesn\'t exist.']);
						}else{
							$task->delete();
							return response()->json(['success'=>'This task has been successfully deleted.']);
						}
					}else{
						return response()->json(['error'=>'This LAN doesn\'t exist.']);
					}
	  		}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to delete a LAN\'s task.');
  		}
    }
}
