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

	/*Returns all the users, withouth duplicates*/
	public function real_users(){
		return $this->users()->groupBy('pivot_user_id','pivot_lan_id','users.id');
  	}

	public function users()
	{
		return $this->belongsToMany('App\User');
	}

  public function games()
  {
    return $this->belongsToMany('App\Game','can_play','id_lan','id_game');
  }

  public function shoppings()
  {
    return $this->hasMany('App\Shopping');
  }

  public function materials()
  {
    return $this->belongsToMany('App\Material','needs','id_lan','id_material');
  }

  public function activities()
  {
    return $this->hasMany('App\Activity');
  }

  public function tournaments()
  {
    return $this->hasMany('App\Tournament');
  }

  public function tasks(){
    return $this->hasMany('App\Task');
  }

  public function ports(){
    return $this->belongsToMany('App\Connexionport','uses_port');
  }

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
