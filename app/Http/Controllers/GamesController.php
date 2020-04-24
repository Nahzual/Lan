<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use App\Game;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('game.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('game.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	   public function store(Request $request){

       if(Auth::check()){
           $user=Auth::user();
           if($user->rank_user==config('ranks.ADMIN')){
             $game = new Game();

             if($request->cost_game >= 0) $game->cost_game=$request->cost_game;
             else return response()->json(['error'=>'The price has to be positive or zero.']);

             if($request->is_multiplayer_game!=config('game.SOLO') && $request->is_multiplayer_game!=config('game.MULTI_LOCAL') &&  $request->is_multiplayer_game!=config('game.MULTI_ONL')){
               return response()->json(['error'=>'Please select "Local Multiplayer", "Online Multiplayer" or "1 player" for the game type.']);
             }else{
               $game->is_multiplayer_game=$request->is_multiplayer_game;
             }

             $game->name_game=$request->name_game;
             $game->desc_game=$request->desc_game;
             $game->release_date_game=$request->release_date_game;
             $game->save();

             return response()->json(['success'=>'The game "'.$game->name_game.'" has been successfully created.']);

           }else{
             return response()->json(['error'=>'You do not have enough rights to do this.']);
           }
       }else{
         return response()->json(['error'=>'Please log in to perform this action.']);
       }
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function show($id)
      {
  		if(Auth::check()){

  			return view('game.show');
  		}else{
  			return redirect('/home');
  		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
  		if(Auth::check()){
          $user=Auth::user();
          if($user->rank_user==config('ranks.ADMIN')){
            return view('game.edit');
          }else{
            return redirect('/home')->with('error','You do not have enough rights to do this.');
          }
  		}else{
  			return redirect('/login')->with('error','Please log in to perform this action.');
  		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if(Auth::check()){
          $user=Auth::user();
          if($user->rank_user==config('ranks.ADMIN')){

          }else{
            return response()->json(['error','You do not have enough rights to do this.']);
          }
      }else{
        return response()->json(['error','Please log in to perform this action.']);
      }
    }

    public function addToFavorite($id){
      if(Auth::check()){
        $game=Game::find($id);
        if($game!=null){
          $user=Auth::user();
          $favorite_game=$user->games()->where('favorite_games.game_id','=',$id)->first();
          if($favorite_game==null){
            $user->games()->attach($game);
            return response()->json(['success'=>'This game has been successfully added to your Favorite list.']);
          }else{
            return response()->json(['error'=>'This game is already in your Favorite list.']);
          }
        }else{
          return response()->json(['error'=>'This game does not exist.']);
        }

      }else{
        return response()->json(['error'=>'Please log in to perform this action.']);
      }
    }

    public function removeFromFavorite($id){
      if(Auth::check()){
        $game=Game::find($id);
        if($game!=null){
          $user=Auth::user();
          $favorite_game=$user->games()->where('favorite_games.game_id','=',$id)->first();
          if($favorite_game!=null){
            $user->games()->detach($game);
            return response()->json(['success'=>'This game has been successfully removed from your Favorite list.']);
          }else{
            return response()->json(['error'=>'This game isn\'t in your Favorite list.']);
          }
        }else{
          return response()->json(['error'=>'This game does not exist.']);
        }

      }else{
        return response()->json(['error'=>'Please log in to perform this action.']);
      }
    }

    public function search(Request $request){
      if(Auth::check()){
        $games=Game::where('name_game','LIKE','%'.$request->name_game.'%')->get();
        $favorite_games=Auth::user()->games;
        return view($request->view_path,compact('games','favorite_games'));
      }else{
        $games=Game::where('name_game','=',$request->name_game)->get();
        return view($request->view_path,compact('games'));
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		return redirect(route('game.index'));
    }
}
