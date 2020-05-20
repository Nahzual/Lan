<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use App\Game;
use App\Tournament;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TournamentsController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(){
		if(Auth::check()){
			$user=Auth::user();
			return view('tournament.index',compact('user'));
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
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
			if($user->lans()->find($lanId)==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t create a tournament for a LAN you are not an admin of.');
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$games=$lan->games;
					return view('tournament.create_tournament', compact('lan', 'games'));
				}else{
					return back()->with('error','This LAN doesn\'t exist.');
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
			if($user->lans()->find($lanId)==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t create a tournament for a LAN you are not an admin of.');
			}else{

				$lan = Lan::find($lanId);
				if($lan!=null){
					$tournament = new Tournament();

					if(isset($request->name_tournament)){
						$tournament->name_tournament = htmlentities($request->name_tournament);
					}else{
						return response()->json(['error'=>'The tournament\'s name is required.']);
					}

					if(isset($request->desc_tournament)){
						$tournament->desc_tournament = htmlentities($request->desc_tournament);
					}else{
						return response()->json(['error'=>'The tournament\'s description is required.']);
					}

					if(isset($request->opening_date_tournament)){
						$date=date_create($request->opening_date_tournament);

						if($date && $date->format('H:i:s')===$request->opening_date_tournament){
							$tournament->opening_date_tournament = htmlentities($request->opening_date_tournament);
						}else{
							return response()->json(['error'=>'The start time is not valid.']);
						}
					}else{
						return response()->json(['error'=>'The tournament\'s start time is required.']);
					}

					if(isset($request->match_mod_tournament) && ($request->match_mod_tournament==config('tournament.SOLO') || $request->match_mod_tournament==config('tournament.TEAM'))){
						$tournament->match_mod_tournament = htmlentities($request->match_mod_tournament);
					}else{
						return response()->json(['error'=>'The tournament\'s mode is required and must be SOLO or TEAM.']);
					}

					if(isset($request->number_per_team) && is_numeric($request->number_per_team) && $request->number_per_team>=1){
						$tournament->number_per_team = htmlentities($request->number_per_team);
					}else if(isset($request->number_per_team)){
						return response()->json(['error'=>'The number of players per team must be a positive number.']);
					}else{
						$tournament->number_per_team = '1';
					}

					if(isset($request->max_player_count_tournament) && is_numeric($request->max_player_count_tournament) && $request->max_player_count_tournament>=1){
						$tournament->max_player_count_tournament = htmlentities($request->max_player_count_tournament);
					}else if(isset($request->max_player_count_tournament)){
						return response()->json(['error'=>'The number of players in the tournament must be a positive number.']);
					}else{
						return response()->json(['error'=>'The number of players in the tournament is required.']);
					}

					if(isset($request->id_game)){
						$game=Game::find($request->id_game);
						if($game!=null){
							$game=$lan->games()->where('game_id','=',$request->id_game)->first();
							if($game!=null){
								$tournament->id_game = htmlentities($request->id_game);
							}else{
								return response()->json(['error'=>'This game is not this in this LAN\'s game list.']);
							}
						}else{
							return response()->json(['error'=>'This game does not exist.']);
						}
					}else{
						return response()->json(['error'=>'The game of this tournament is required.']);
					}

					$tournament->lan()->associate($lan->id);
					$tournament->save();

					return response()->json([
						'success'=>'Your tournament has been saved successfully.'
					]);
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}
		}else{
			return response()->json(['error'=>'You must be logged in to create a tournament.']);
		}
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($lanId, $tournamentId){
		if(Auth::check()){
			$lan=Lan::find($lanId);
			if($lan!=null){
				$tournament=$lan->tournaments()->find($tournamentId);
				if($tournament!=null){
					$game=$tournament->game;
					$user=Auth::user();
					$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lan_user.lan_id','=',$lanId)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
					$teams=Team::where('tournament_id', '=', $tournamentId)->get();

					if($tournament->match_mod_tournament==config('tournament.SOLO') || $tournament->number_per_team==1){
						$players=$teams->toBase();
						foreach($players as $key=>$team){
							$players[$key]=$team->users()->first();
						}
						return view('tournament.show_tournament', compact('lan', 'tournament', 'game', 'userIsLanAdmin', 'players'));

					}else{
						$players_count=$tournament->players_count($teams);
						return view('tournament.show_tournament', compact('lan', 'tournament', 'game', 'userIsLanAdmin', 'teams','players_count'));
					}

				}else{
					return back()->with('error','This tournament doesn\'t exist.');
				}
			}else{
				return back()->with('error','This LAN doesn\'t exist.');
			}
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
		}
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($lanId, $tournamentId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t edit a tournament if you are not an admin of its LAN.');
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$tournament = $lan->tournaments()->find($tournamentId);
					if($tournament == null){
						return back()->with('error','This tournament doesn\'t exist.');
					}else{
						$games=$lan->games;
						return view('tournament.edit_tournament', compact('lan', 'tournament', 'games'));
					}
				}else{
					return redirect('/login')->with('error','This LAN does not exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s tournament.');
		}
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $lanId, $tournamentId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
				return response()->json(['error'=>'You can\'t edit a tournament if you are not an admin of its LAN.']);
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$tournament = $lan->tournaments()->find($tournamentId);
					if($tournament == null){
						return response()->json(['error'=>'This tournament doesn\'t exist.']);
					}else{

						if(isset($request->name_tournament)){
							$tournament->name_tournament = htmlentities($request->name_tournament);
						}

						if(isset($request->desc_tournament)){
							$tournament->desc_tournament = htmlentities($request->desc_tournament);
						}

						if(isset($request->opening_date_tournament)){
							$date=date_create($request->opening_date_tournament);

							if($date && $date->format('H:i:s')===$request->opening_date_tournament){
								$tournament->opening_date_tournament = htmlentities($request->opening_date_tournament);
							}else{
								return response()->json(['error'=>'The start time is not valid.']);
							}
						}

						if(isset($request->match_mod_tournament) && ($request->match_mod_tournament==config('tournament.SOLO') || $request->match_mod_tournament==config('tournament.TEAM'))){
							$tournament->match_mod_tournament = htmlentities($request->match_mod_tournament);
						}

						if(isset($request->number_per_team) && is_numeric($request->number_per_team) && $request->number_per_team>=1){
							$tournament->number_per_team = htmlentities($request->number_per_team);
						}else if(isset($request->number_per_team)){
							return response()->json(['error'=>'The number of players per team must be a positive number.']);
						}

						if(isset($request->max_player_count_tournament) && is_numeric($request->max_player_count_tournament) && $request->max_player_count_tournament>=1){
							$tournament->max_player_count_tournament = htmlentities($request->max_player_count_tournament);
						}else if(isset($request->max_player_count_tournament)){
							return response()->json(['error'=>'The number of players in the tournament must be a positive number.']);
						}

						if(isset($request->id_game) && $request->id_game!=$tournament->id_game){
							$game=Game::find($request->id_game);
							if($game!=null){
								$game=$lan->games()->where('game_id','=',$request->id_game)->first();
								if($game!=null){
									$tournament->id_game = htmlentities($request->id_game);
								}else{
									return response()->json(['error'=>'This game is not this in this LAN\'s game list.']);
								}
							}else{
								return response()->json(['error'=>'This game does not exist.']);
							}
						}

						$tournament->save();
						return response()->json(['success'=>'The tournament "'.$tournament->name_tournament.'" has been successfully edited.']);
					}
				}else{
					return back()->with('error','This LAN doesn\'t exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s tournament.');
		}
	}

	public function join($tournamentId,$userId){
		if(Auth::check()){
			$logged_user=Auth::user();
			$tournament=Tournament::find($tournamentId);
			if($tournament!=null){
				if($logged_user->isSiteAdmin() || $logged_user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($tournament->lan_id)!=null){
					$user=User::find($userId);
					if($user!=null){
						$lan=$tournament->lan;
						$user=$lan->users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->find($userId);
						if($user!=null){
							$user_tour=Team::where('teams.tournament_id','=',$tournamentId)->join('part_of','part_of.team_id','=','teams.id')->where('part_of.user_id','=',$user->id)->first();
							if($user_tour==null){
								$team=new Team();
								$team->name_team=$user->pseudo;
								$team->tournament()->associate($tournament);
								$team->save();
								$team->users()->attach($user,['tournament_id'=>$tournament->id]);

								return response()->json(['success'=>"The user ".$user->pseudo." has been successfully added to this tournament."]);
							}else{
								return response()->json(['error'=>"This user has already been added to this tournament."]);
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
				return response()->json(['error'=>'This tournament does not exist.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

	public function joinList($tournamentId,$page=1,Request $request){
		if(Auth::check()){
			$logged_user=Auth::user();
			$tournament=Tournament::find($tournamentId);
			if($tournament!=null){
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

					return view('tournament.add_user',compact('tournament','users','max','previous','next','page'));

				}else{
					return back()->with(['error'=>'You do not have enough rights.']);
				}
			}else{
				return back()->with(['error'=>'This tournament does not exist.']);
			}
		}else{
			return back()->with(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($lanId, $tournamentId){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->isSiteAdmin()){
				return response()->json(['error'=>'You can\'t delete a tournament if you are not an admin of its LAN.']);
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$tournament = $lan->tournaments()->find($tournamentId);
					if($tournament == null){
						return response()->json(['error'=>'This tournament doesn\'t exist.']);
					}else{
						$tournament->delete();
						return response()->json(['success'=>'This tournament has been successfully deleted.']);
					}
				}else{
					return response()->json(['error'=>'This LAN doesn\'t exist.']);
				}
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to delete a LAN\'s tournament.');
		}
	}

	/**
	* Tournament List
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function admList($page = 1){
		if(Auth::check()){
			$user=Auth::user();
			if(!$user->isSiteAdmin()){
				return back()->with('error','You are not an Admin');
			}else{
				$tu = Tournament::selectRaw('COUNT(*) AS count')->first();
				if($tu!=null){
					$tu=$tu->count;
				}else{
					$tu=0;
				}
				$tournaments= Tournament::skip(abs(($page - 1)*10))->take(10)->get();

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
				//reduce tournaments before compacting (limit the amount of information like emails)
				return view('tournament.all', compact('tournaments', 'max', 'previous', 'next', 'page'));
			}
		}else{
			return redirect('/login')->with('error','Please log in to perform this action.');
		}
	}
}
