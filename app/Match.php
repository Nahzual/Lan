<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
	protected $fillable = ['id_round'];
	
	/*Returns all the teams for this match*/
	public function teams(){
		return $this->belongsToMany('App\Team','oppose');
	}

	/*Returns the round of this match*/
	public function round(){
		return $this->belongsTo('App\Round');
	}
}
