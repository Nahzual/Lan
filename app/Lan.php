<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lan extends Model
{
    protected $fillable = ['name','max_num_registrants','opening_date','duration','budget','waiting_lan'];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}

  public function games()
  {
    return $this->belongsToMany('App\Game','can_play');
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
    return $this->hasOne('App\Location');
  }
}
