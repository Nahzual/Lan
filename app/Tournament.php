<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{

	protected $fillable = ['name_tournament','desc_tournament','opening_date_tournament', 'is_finished_tournament', 'player_count', 'match_mod', 'max_player_count', 'lan_id', 'number_per_team'];

	/*Returns all the rounds for this tournament*/
	public function rounds(){
		return $this->hasMany('App\Round');
	}

	/*Returns all the games for this tournament*/
	public function games(){
		return $this->hasOne('App\Game');
	}

	/*Returns the parent LAN of this tournament*/
	public function lan(){
		return $this->belongsTo('App\Lan');
	}

	/*Returns all the teams for this tournament*/
	public function team(){
		return $this->hasMany('App\Team');
	}
}
