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
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TournamentsController extends Controller
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
    public function create($lanId)
    {
      if(Auth::check()){
     			$user=Auth::user();
     			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
     				return back()->with('error','You can\'t add a tournament to a LAN you are not an admin of.');
     			}else{
   					$lan = $user->lans()->find($lanId);
            $games=Game::all();
     				return view('tournament.create_tournament', compact('lan', 'games'));
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
      			if($user->lans()->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
      				return back()->with('error','You can\'t add a tournament to a LAN you are not an admin of.');
      			}else{

    					$lan = $user->lans()->find($lanId);
      				$tournament = new Tournament();
    					$tournament->name_tournament = htmlentities($request->name_tournament);
    					$tournament->desc_tournament = htmlentities($request->desc_tournament);
             $tournament->opening_date_tournament = htmlentities($request->opening_date_tournament);
             $tournament->match_mod_tournament = htmlentities($request->match_mod_tournament);
             $tournament->max_player_count_tournament = htmlentities($request->max_player_count_tournament);
             $tournament->id_game = htmlentities($request->id_game);
             $tournament->lan()->associate($lan->id);

    					$tournament->save();

             return response()->json([
               'success'=>'Your tournament has been saved successfully.'
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
    public function destroy($lanId, $tournamentId)
    {
      if(Auth::check()){
        $user=Auth::user();
        if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
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
}
