<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
	protected $fillable = ['name_team','number_of_member','statue_of_team', 'id_tournament', 'player_count'];

	/*Nename required (matchs => matches)*/
	public function matchs(){
		return $this->hasMany('App\Match', 'oppose');
	}

	/*Returns the users part of the team*/
	public function users(){
		return $this->belongsToMany('App\User', 'part_of');
	}

	/*Returns the tournament*/
	public function tournament(){
		return $this->belongsTo('App\Tournament');
	}
}
