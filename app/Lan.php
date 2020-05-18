<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lan extends Model
{
	protected $fillable = ['name','max_num_registrants','opening_date','duration','budget','waiting_lan'];

	/*Returns the user count, without duplicates*/
	public function real_user_count(){
 		return count($this->real_users()->select('users.id')->get());
  	}

	/*Returns all the users, without duplicates*/
	public function real_users(){
		return $this->users()->groupBy('pivot_user_id','pivot_lan_id','users.id');
  	}

	/*Returns all the users for a LAN, with duplicates*/
	public function users(){
		return $this->belongsToMany('App\User');
	}

	/*Returns all the games for a LAN*/
	public function games(){
		return $this->belongsToMany('App\Game','can_play','id_lan','id_game');
	}

	/*Returns the shopping list for a LAN*/
	public function shoppings(){
		return $this->hasMany('App\Shopping');
  	}

	/*Returns all the materials required for a LAN*/ 
	public function materials(){
		return $this->belongsToMany('App\Material','needs','id_lan','id_material');
	}

	/*Returns all the activities for a LAN*/
	public function activities(){
		return $this->hasMany('App\Activity');
	}
	
	/*Returns all the tournaments for a LAN*/
	public function tournaments(){
		return $this->hasMany('App\Tournament');
	}
	
	/*Returns all the tasks for a LAN*/
	public function tasks(){
		return $this->hasMany('App\Task');
	}

	/*Returns all the connexion ports for a LAN*/
	public function ports(){
		return $this->belongsToMany('App\Connexionport','uses_port');
	}

	/*Returns the location of the LAN*/
	public function location(){
		return $this->belongsTo('App\Location');
	}
	public function street(){
		return $this->location()->belongsTo('App\Street');
	}
	public function city(){
		return $this->street()->belongsTo('App\City');
	}
	public function department(){
		return $this->city()->belongsTo('App\Department');
	}
	public function country(){
		return $this->department()->belongsTo('App\Country');
	}

	/*Returns the total cost for the LAN's shopping list*/
	public function price_shopping($shoppings=null){
		if($shoppings==null){
			$shoppings=$this->shoppings;
		}
		$totalprice_shopping = 0;
		foreach($shoppings as $shopping){
			$totalprice_shopping += $shopping->cost_shopping*$shopping->quantity_shopping;
		}

		return $totalprice_shopping;
	}
}
