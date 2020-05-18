<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TasksController extends Controller{

	/**
	* Display a list of the user's tasks
	*
	* @return \Illuminate\Http\Response
	*/
	public function all(){
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
	public function create($lanId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t add a task to a LAN if you are not an admin of this LAN.');
			}else{
				$lan=Lan::find($lanId);
				if($lan!=null){
					return view('task.create', compact('lan'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
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
	public function store(Request $request, $lanId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t add a task to a LAN if you are not an admin of this LAN.');
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$task = new Task();
					$task->name_task = htmlentities($request->name_task);
					$task->desc_task = htmlentities($request->desc_task);
					$task->deadline_task = htmlentities($request->deadline_task);
					$task->lan_id=htmlentities($lan->id);
					$task->save();

					return response()->json([
						'success'=>'Your Task has been saved successfully.'
					]);
				}else{
					return response()->json([
						'error'=>'This LAN does not exist.'
					]);
				}
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
	public function show($lanId, $taskId){
		if(Auth::check()){
			$user=Auth::user();
			$lan=Lan::find($lanId);
			if($lan!=null){

				$lan_user=$user->lans()->where('lan_user.lan_id','=',$lanId)->where(function($query){
					$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
					->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
				})->select('lans.*','lan_user.rank_lan')->first();

				if($lan_user!=null || $user->isSiteAdmin()){
					$task=$lan->tasks()->find($taskId);
					if($task!=null){
						$userIsLanAdmin=($user->isSiteAdmin()) || ($lan->rank_lan==config('ranks.ADMIN'));
						$users=$task->users;
						return view('task.show', compact('lan', 'task','users','userIsLanAdmin'));
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
	public function edit($lanId, $taskId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
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
	public function update(Request $request, $lanId, $taskId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
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

	public function addHelper($lanID,$taskID){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanID);
			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You have to be an admin of this LAN to add helpers to it.');
			}else{
				$lan=Lan::find($lanID);
				if($lan!=null){
					$task=$lan->tasks()->find($taskID);
					if($task!=null){
						return view('task.add_helper',compact('lan','task'));
					}else{
						return back()->with('error','This task does not exist.');
					}
				}else{
					return back()->with('error','This LAN does not exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Assigns the specified task to the specified user
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function assign(Request $request, $lanId, $taskId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
				return response()->json(['error'=>'You can\'t assign a user to a task if you are not an admin of its LAN.']);
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$task = $lan->tasks()->find($taskId);
					if($task != null){
						if(isset($request->user_id)){
							$user=User::find($request->user_id);
							if($user!=null){
								$user_helper=$lan->users()->where(function($query){
									$query->where('lan_user.rank_lan','=',config('ranks.HELPER'))
									->orWhere('lan_user.rank_lan','=',config('ranks.ADMIN'));
								})->find($user->id);

								if($user_helper!=null){
									$user_task=$task->users()->where('assigned_to.user_id','=',$user->id)->first();
									if($user_task==null){
										$task->users()->attach($user->id);
										return response()->json(['success'=>'The task "'.$task->name_task.'" has been successfully assigned to the user "'.$user->name.' '.$user->lastname.'".']);
									}else{
										return response()->json(['error'=>'This task has already been assigned to this user.']);
									}
								}else{
									return response()->json(['error'=>'You can\'t assign a task to user that is not admin or helper on its LAN.']);
								}
							}else{
								return response()->json(['error'=>'This user doesn\'t exist.']);
							}
						}else{
							return response()->json(['error'=>'Please provide the user to which you want to assign this task.']);
						}
					}else{
						return response()->json(['error'=>'This task doesn\'t exist.']);
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
	* Removes the specified task from the specified user
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function unassign(Request $request, $lanId, $taskId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
				return response()->json(['error'=>'You can\'t remove a user from a task if you are not an admin of its LAN.']);
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$task = $lan->tasks()->find($taskId);
					if($task != null){
						if(isset($request->user_id)){
							$user=User::find($request->user_id);
							if($user!=null){
								$user_task=$task->users()->where('user_id','=',$user->id)->first();
								if($user_task!=null){
									$task->users()->detach($user->id);
									return response()->json(['success'=>'This user has been successfully removed from this task.']);
								}else{
									return response()->json(['error'=>'This task isn\'t assigned to this user.']);
								}
							}else{
								return response()->json(['error'=>'This user doesn\'t exist.']);
							}
						}else{
							return response()->json(['error'=>'Please provide the user you want to remove from this tasks\' helper list.']);
						}
					}else{
						return response()->json(['error'=>'This task doesn\'t exist.']);
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
	public function destroy($lanId, $taskId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
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
