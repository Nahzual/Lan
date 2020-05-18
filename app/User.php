<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;

	protected $fillable = ['name', 'lastname', 'pseudo', 'email', 'tel_user', 'password', 'theme'];

	protected $hidden = ['password', 'remember_token'];

	protected $casts = ['email_verified_at' => 'datetime'];

	/*Returns all the LANs with this user*/
	public function lans(){
		return $this->belongsToMany('App\Lan');
	}

	/*Returns all the tasks assigned to this user*/
	public function tasks(){
		return $this->belongsToMany('App\Task','assigned_to');
	}

	/*Returns all the favorite games for this user*/
	public function games(){
		return $this->belongsToMany('App\Game','favorite_games');
	}

	/*Returns all the teams with this user*/
	public function teams(){
		return $this->belongsToMany('App\Team','part_of');
	}

	/*Returns the location of this user*/
	public function location(){
		return $this->belongsTo('App\Location');
	}

	/*Returns a boolean to check if this user is a site admin or not*/
	public function isSiteAdmin(){
		return $this->rank_user==config('ranks.SITE_ADMIN');
	}
}
