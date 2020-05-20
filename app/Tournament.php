<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{

	protected $fillable = ['name_tournament','desc_tournament','opening_date_tournament', 'is_finished_tournament', 'player_count', 'match_mod', 'max_player_count', 'lan_id','id_game', 'number_per_team'];

	/*Returns all the rounds for this tournament*/
	public function rounds(){
		return $this->hasMany('App\Round');
	}

	/*Returns the game pf this tournament*/
	public function game(){
		return $this->belongsTo('App\Game','id_game');
	}

	/*Returns the parent LAN of this tournament*/
	public function lan(){
		return $this->belongsTo('App\Lan');
	}

	/*Returns all the teams for this tournament*/
	public function teams(){
		return $this->hasMany('App\Team');
	}

	/*Returns the number of users that joined this tournament*/
	public function players_count($teams=null){
		if($teams==null) $teams=$this->teams;

		$players_count=0;
		foreach($teams as $team){
			$count=$team->users()->selectRaw('COUNT(*) as count')->first();
			if($count==null) $count=0;
			else $count=$count->count;
			$players_count+=$count;
		}
		return $players_count;
	}

	/*Returns the number of teams created for that tournament*/
	public function teams_count($teams=null){
		if($teams==null) $teams=$this->teams;
		return count($teams);
	}
}
