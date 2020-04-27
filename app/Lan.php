<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lan extends Model
{
    protected $fillable = ['name','max_num_registrants','opening_date','duration','budget','waiting_lan'];

  public function real_user_count(){
    return count($this->real_users);
  }

  public function real_users(){
    return $this->users()->groupBy('pivot_user_id','pivot_lan_id');
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
    return $this->belongsToMany('App\Shopping','requires');
  }

  public function materials()
  {
    return $this->belongsToMany('App\Material','needs');
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
}
