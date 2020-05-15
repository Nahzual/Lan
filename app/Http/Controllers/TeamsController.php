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
  public function index()
  {
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
  public function create($tournamentId)
  {
    if(Auth::check()){
      $user=Auth::user();
      $tournament = Tournament::find($tournamentId);
      $lan = Lan::find($tournament->lan_id);
      $lan_user_player = DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->first();
      if($lan_user_player!=null){
        $already_in_team = DB::table('part_of')->where('user_id', $user->id)->where('tournament_id', $tournament->id)->where('team_id','!=',null)->first();
        if($already_in_team==null){
          $userList = $lan->users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->get();
          return view('team.create_team', compact('tournament', 'user', 'userList'));
        }else{
          return redirect('/lan/{lan}/tournament/{tournament}/show')->with('error', 'You are already in team for this tournament');
        }
      }else{
        return redirect('/lan/{lan}/tournament/{tournament}/show')->with('error', 'You must be registered with the LAN.');
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
   public function store(Request $request, $tournamentId){
     if(Auth::check()){
       $user=Auth::user();
       $already_in_team = DB::table('part_of')->where('user_id', $user->id)->where('tournament_id', $tournamentId)->where('team_id','!=',null)->first();
       if($already_in_team==null){
         $user=Auth::user();
          $tournament = Tournament::find($tournamentId);
          $team = new Team();
          $team->name_team = htmlentities($request->name_team);
          $team->tournament()->associate($tournament->id);
          $team->save();
          $team->users()->attach($user, ['tournament_id'=>$tournamentId]);

          return response()->json([
           'success'=>'Your tournament has been saved successfully.'
          ]);
        }else{
          return redirect('/lan/{lan}/tournament/{tournament}/show')->with('error', 'You are already in team for this tournament');
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
    public function show($lanId, $tournamentId)
    {
      if(Auth::check()){

        $lan=Lan::find($lanId);
        if($lan!=null){
          $tournament=$lan->tournaments()->find($tournamentId);
          $games=Game::all();
          if($tournament!=null){
            if(Auth::check()){
              $userIsLanAdmin=Auth::user()->lans()->where('lan_user.lan_id','=',$lanId)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
              return view('tournament.show_tournament', compact('lan', 'tournament', 'games', 'userIsLanAdmin'));
            }else{
              return view('tournament.show_tournament', compact('lan', 'tournament', 'games'));
            }
          }else{
            return back()->with('error','This tournament doesn\'t exist.');
          }
        }else{
          return back()->with('error','This LAN doesn\'t exist.');
        }
      }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($lanId, $tournamentId)
       {
         if(Auth::check()){
             $user=Auth::user();
             if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
               return back()->with('error','You can\'t edit a tournament if you are not an admin of its LAN.');
             }else{
               $lan = Lan::find($lanId);
               $games=Game::all();
               if($lan!=null){
                 $tournament = $lan->tournaments()->find($tournamentId);
                 $games=$lan->games()->find($tournament->id_game);
                 if($tournament == null){
                   return back()->with('error','This tournament doesn\'t exist.');
                 }else{
                   $games=Game::all();
                   return view('tournament.edit_tournament', compact('lan', 'tournament', 'games'));
                 }
               }else{
                 return back()->with('error','This LAN doesn\'t exist.');
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
   public function update(Request $request, $lanId, $tournamentId)
      {
        if(Auth::check()){
          $user=Auth::user();
          if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
            return response()->json(['error'=>'You can\'t edit a tournament if you are not an admin of its LAN.']);
          }else{
            $lan = Lan::find($lanId);
            if($lan!=null){
              $tournament = $lan->tournaments()->find($tournamentId);
              if($tournament == null){
                return response()->json(['error'=>'This tournament doesn\'t exist.']);
              }else{
                $tournament->update($request->all());
                $tournament->save();
                $games=Game::all();
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($tournamentId, $teamId)
  {
    if(Auth::check()){
      $user=Auth::user();
      $team= Team::find($teamId);
      $tournamentId= $team->tournament_id;
      $tournament = Tournament::find($tournamentId);
      $lan = Lan::find($tournament->lan_id);
      if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
        return response()->json(['error'=>'You can\'t delete a team if you are not an admin of its LAN.']);
      }else{
        if($lan!=null){
          if($team == null){
            return response()->json(['error'=>'This team doesn\'t exist.']);
          }else{
            $team->delete();
            return response()->json(['success'=>'This team has been successfully deleted.']);
          }
        }else{
          return response()->json(['error'=>'This team doesn\'t exist.']);
        }
      }
    }else{
      return redirect('/login')->with('error','You must be logged in to delete a tournament\'s team.');
    }
  }


   public function joinTeam($teamId){
     if(Auth::check()){
       $user=Auth::user();
       $team= Team::find($teamId);
       $tournamentId= $team->tournament_id;
       $tournament = Tournament::find($tournamentId);
       $lan = Lan::find($tournament->lan_id);
       $lan_user_player = DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->first();
       if($lan_user_player!=null){
         $already_in_team = DB::table('part_of')->where('user_id', $user->id)->where('tournament_id', $tournament->id)->where('team_id','!=',null)->first();
         if($already_in_team==null){
           $team->users()->attach($user, ['tournament_id'=>$tournamentId]);
           $team->number_of_member+=1;
           return response()->json(['success'=>'You are join this team.']);
         }else{
           return response()->jason(['error'=>'You are already in team for this tournament']);
         }
       }else{
         return response()->json(['error'=>'You must be registered with the LAN.']);
       }
     }else{
        return redirect('/login')->with('error','You must be logged in to edit a LAN.');
      }
    }
}
