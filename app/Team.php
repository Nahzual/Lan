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

  public function matchs(){
    return $this->hasMany('App\Match', 'oppose');
  }
  public function users(){
    return $this->belongsToMany('App\User', 'part_of');
  }
  public function tournament(){
    return $this->belongsTo('App\Tournament');
  }
}
