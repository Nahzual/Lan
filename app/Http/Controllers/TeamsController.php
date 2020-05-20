<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use App\Tournament;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TeamsController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(){
		if(Auth::check()){
			$user=Auth::user();
			return view('team.index');
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
		}
	}

	/**
	* Show the form for creating a new resource.
	*
	* @param int $tournamentId
	* @return \Illuminate\Http\Response
	*/
	public function create($tournamentId){
		if(Auth::check()){
			$user=Auth::user();
			$tournament = Tournament::find($tournamentId);
			if($tournament!=null){
				if($tournament->match_mod_tournament==config('tournament.TEAM') && $tournament->number_per_team!=1){
					$players_count=$tournament->teams_count()*$tournament->number_per_team;
					if($tournament->max_player_count_tournament-$players_count>=$tournament->number_per_team){
						$lan=$tournament->lan;
						if($user->isSiteAdmin() || $user->lans()->where('lan_user.lan_id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()){
							return view('team.create_team', compact('tournament'));
						}else{
							return back()->with('error', 'You must be an admin of the LAN to perform this action.');
						}
					}else{
						return back()->with('error', 'You can\'t create a new team, because the number of players will exceed the maximum number of players of this tournament.');
					}
				}else{
					return back()->with(['error'=>'You can\'t create a team for this tournament as it is in SOLO mode.']);
				}
			}else{
				return back()->with('error', 'This tournament does not exist.');
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
		}
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param int $tournamentId
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request, $tournamentId){
		if(Auth::check()){
			$user=Auth::user();
			$tournament = Tournament::find($tournamentId);
			if($tournament!=null){
				if($tournament->match_mod_tournament==config('tournament.TEAM') && $tournament->number_per_team!=1){
					$lan=$tournament->lan;
					if($user->isSiteAdmin() || $user->lans()->where('lan_user.lan_id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()){
						$players_count=$tournament->teams_count()*$tournament->number_per_team;
						if($tournament->max_player_count_tournament-$players_count>=$tournament->number_per_team){
							if(isset($request->name_team)){
								$team = new Team();
								$team->name_team = htmlentities($request->name_team);
								$team->tournament()->associate($tournament->id);
								$team->save();

								return response()->json([
									'success'=>'Your team has been saved successfully.'
								]);
							}else{
								return response()->json([
									'error'=>"The team's name is required."
								]);
							}
						}else{
							return response()->json(['error'=>'You can\'t create a new team, because the number of players will exceed the maximum number of players of this tournament.']);
						}
					}else{
						return response()->json([
							'error'=>"You must be an admin of the LAN to perform this action."
						]);
					}
				}else{
					return response()->json(['error'=>'You can\'t create a team for this tournament as it is in SOLO mode.']);
				}
			}else{
				return response()->json(['error'=>'This tournament does not exist.']);
			}
		}else{
			return response()->json(['error'=>'You must be logged in to create a team.']);
		}
	}

	/**
	* Display the specified resource.
	*
	* @param int $tournamentId
	* @param int $teamId
	* @return \Illuminate\Http\Response
	*/
	public function show($tournamentId, $teamId){
		if(Auth::check()){
			$tournament=Tournament::find($tournamentId);
			if($tournament!=null){
				$team=$tournament->teams()->find($teamId);
				if($team!=null){
					$users = $team->users;
					$userIsLanAdmin=Auth::user()->lans()->where('lan_user.lan_id','=',$tournament->lan_id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
					return view('team.players_team', compact('tournament', 'team', 'userIsLanAdmin', 'users'));
				}else{
					return back()->with('error','This team doesn\'t exist.');
				}
			}else{
				return back()->with('error','This tournament doesn\'t exist.');
			}
		}
	}


	/**
	* Show the form for editing the specified resource.
	*
	* @param int $tournamentId
	* @param int $teamId
	* @return \Illuminate\Http\Response
	*/
	public function edit($tournamentId,$teamId){
		if(Auth::check()){
			$user=Auth::user();
			$tournament=Tournament::find($tournamentId);
			if($tournament!=null){
				if(!$user->isSiteAdmin() && $user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($tournament->lan_id)==null){
					return back()->with('error','You can\'t edit a team if you are not an admin of its LAN.');
				}else{
					$team=$tournament->teams()->find($teamId);
					if($team!=null){
						return view('team.edit', compact('team', 'tournament'));
					}else{
						return back()->with('error','This team doesn\'t exist.');
					}
				}
			}else{
				return back()->with('error','This tournament doesn\'t exist.');
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s tournament.');
		}
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param int $tournamentId
	* @param int $teamId
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $tournamentId, $teamId){
		if(Auth::check()){
			$user=Auth::user();
			$tournament=Tournament::find($tournamentId);
			if($tournament!=null){
				if(!$user->isSiteAdmin() && $user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($tournament->lan_id)==null){
					return back()->with('error','You can\'t edit a team if you are not an admin of its LAN.');
				}else{
					$team=$tournament->teams()->find($teamId);
					if($team!=null){
						if(isset($request->name_team)){
							$team->name_team=htmlentities($request->name_team);
							$team->save();
						}
						return response()->json(['success'=>'The team '.$team->name_team.' has been successfully edited.']);
					}else{
						return response()->json(['error'=>'This team doesn\'t exist.']);
					}
				}
			}else{
				return response()->json(['error'=>'This tournament doesn\'t exist.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param int $tournamentId
	* @param int $teamId
	* @return \Illuminate\Http\Response
	*/
	public function destroy($tournamentId, $teamId){
		if(Auth::check()){
			$user=Auth::user();
			$tournament = Tournament::find($tournamentId);
			if($tournament!=null){
				if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($tournament->lan_id)==null && !$user->isSiteAdmin()){
					return response()->json(['error'=>'You can\'t delete a team if you are not an admin of its LAN.']);
				}else{
					$team = $tournament->teams()->find($teamId);
					if($team == null){
						return response()->json(['error'=>'This team doesn\'t exist.']);
					}else{
						$team->delete();
						return response()->json(['success'=>'This team has been successfully deleted.']);
					}
				}
			}else{
				return response()->json(['error'=>'This tournament doesn\'t exist.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	* Make the specified user join the specified team
	*
	* @param int $teamId
	* @param int $userId
	* @return \Illuminate\Http\Response
	*/
	public function join($teamId,$userId){
		if(Auth::check()){
			$logged_user=Auth::user();
			$team=Team::find($teamId);
			if($team!=null){
				$tournament=$team->tournament()->select('tournaments.lan_id','tournaments.number_per_team','tournaments.id AS tournament_id')->first();
				if($logged_user->isSiteAdmin() || $logged_user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($tournament->lan_id)!=null){
					$user=User::find($userId);
					if($user!=null){
						$lan=$tournament->lan;
						$user=$lan->users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->find($userId);
						if($user!=null){
							$user_tour=Team::where('teams.tournament_id','=',$tournament->tournament_id)->join('part_of','part_of.team_id','=','teams.id')->where('part_of.user_id','=',$user->id)->first();
							if($user_tour==null){
								$player_count_team=$team->users()->selectRaw('COUNT(*) AS count')->first();
								if($player_count_team==null) $player_count_team=0;
								else $player_count_team=$player_count_team->count;

								if($player_count_team<$tournament->number_per_team){
									$team->users()->attach($user,['tournament_id'=>$tournament->tournament_id]);
									return response()->json(['success'=>"The user ".$user->pseudo." has been successfully added to this team."]);
								}else{
									return response()->json(['error'=>"This team is already full."]);
								}
							}else{
								return response()->json(['error'=>"This user is already in a team for this tournament."]);
							}
						}else{
							return response()->json(['error'=>"This user can't join this tournament because he didn't join this tournament's LAN."]);
						}
					}else{
						return response()->json(['error'=>'This user does not exist.']);
					}
				}else{
					return response()->json(['error'=>'You do not have enough rights.']);
				}
			}else{
				return response()->json(['error'=>'This team does not exist.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	* Show a list of the users who can join the specified team
	* Every player of the team's LAN can join it
	*
	* @param int $teamId
	* @param int $page
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function joinList($teamId,$page=1,Request $request){
		if(Auth::check()){
			$logged_user=Auth::user();
			$team=Team::find($teamId);
			if($team!=null){
				$tournament=$team->tournament()->select('tournaments.lan_id')->first();
				if($logged_user->isSiteAdmin() || $logged_user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($tournament->lan_id)!=null){
					$lan=$tournament->lan;

					if(isset($request->pseudo)){
						$tu = $lan->users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->where('pseudo','LIKE','%'.$request->pseudo.'%')->selectRaw('COUNT(*) AS count')->first();
						if($tu!=null){
							$tu=$tu->count;
						}else{
							$tu=0;
						}
						$users= $lan->users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->where('pseudo','LIKE','%'.$request->pseudo.'%')->skip(abs(($page - 1)*10))->take(10)->get();
					}else{
						$tu = $lan->users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->selectRaw('COUNT(*) AS count')->first();
						if($tu!=null){
							$tu=$tu->count;
						}else{
							$tu=0;
						}
						$users= $lan->users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->skip(abs(($page - 1)*10))->take(10)->get();
					}

					$max = ceil($tu/10);

					if(($page+1)*10>($max*10)){
						$next = 0;
					}else{
						$next = $page + 1;
					}

					if($page == 1){
						$previous = 0;
					}else{
						$previous = $page-1;
					}

					return view('team.add_user',compact('tournament','team','users','max','previous','next','page'));

				}else{
					return back()->with(['error'=>'You do not have enough rights.']);
				}
			}else{
				return back()->with(['error'=>'This team does not exist.']);
			}
		}else{
			return back()->with(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	* Make the specified user leave the specified team
	*
	* @param int $teamId
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function leaveTeam($teamId,Request $request){
		if(Auth::check()){
			$logged_user=Auth::user();
			$team=Team::find($teamId);
			if($team!=null){
				$tournament= $team->tournament;
				$lan=$tournament->lan;
				if($logged_user->isSiteAdmin() || $logged_user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lan->id)!=null){
					if(isset($request->user_id)){
						$user=User::find($request->user_id);
						if($user!=null){
							$already_in_team=$team->users()->where('user_id','=',$user->id)->first();
							if($already_in_team!=null){
								$team->users()->detach($user);
								return response()->json(['success'=>'This user is no longer in this team.']);
							}else{
								return response()->json(['error'=>'This user isn\'t part of this team.']);
							}
						}else{
							return response()->json(['error'=>'This user does not exist.']);
						}
					}else{
						return response()->json(['error'=>'Please provide a user.']);
					}
				}else{
					return response()->json(['error'=>'You must admin of this LAN to do this.']);
				}
			}else{
				return response()->json(['error'=>'This team does not exist.']);
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
		}
	}
}
