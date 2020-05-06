<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Task;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TasksController extends Controller
{

		/**
		 * Display a list of the user's tasks
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function all()
		{
			if(Auth::check()){
				$tasks=Auth::user()->tasks()->join('lans','lans.id','=','tasks.lan_id')->select('tasks.*','lans.name')->get();
				$tasks=collect($tasks)->groupBy('lan_id');
				return view('task.all', compact('tasks'));
			}else{
				return redirect('/login')->with('error','Please log in to access this page.');
			}
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
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t add a task to a LAN if you are not an admin of this LAN.');
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
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t add a task to a LAN if you are not an admin of this LAN.');
  			}else{
					$lan = $user->lans()->find($lanId);
  				$task = new Task();
					$task->name_task = htmlentities($request->name_task);
					$task->desc_task = htmlentities($request->desc_task);
					$task->deadline_task = htmlentities($request->deadline_task);
					$task->lan_id=htmlentities($lan->id);
					$task->save();

					return response()->json([
						'success'=>'Your Task has been saved successfully.'
					]);
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to add a task to a LAN.');
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
			if(Auth::check()){
				$lan=Lan::find($lanId);
				if($lan!=null){
					$lan=Auth::user()->lans()->where('lan_user.lan_id','=',$lanId)->where(function($query){
						$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
									->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
					})->first();
					if($lan!=null){
						$task=$lan->tasks()->find($taskId);
						if($task!=null){
							$userIsLanAdmin=$lan->lan_user==config('ranks.ADMIN');
							return view('task.show', compact('lan', 'task','userIsLanAdmin'));
						}else{
							return back()->with('error','This task doesn\'t exist.');
						}
					}else{
						return back()->with('error','You must be an admin or helper of this LAN to view its tasks.');
					}
				}else{
					return back()->with('error','This LAN doesn\'t exist.');
				}
			}else{
				return redirect('/login')->with('error','Please login to have access to this page.');
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
						$task = $lan->tasks()->find($taskId);
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
						if($task == null){
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
