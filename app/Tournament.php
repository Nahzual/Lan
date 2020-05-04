<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name_tournament','desc_tournament','opening_date_tournament', 'is_finished_tournament', 'player_count', 'match_mod', 'max_player_count', 'lan_id'];

  public function rounds()
  {
    return $this->hasMany('App\Round');
  }

  public function games(){
    return $this->hasOne('App\Game');
  }

  public function lan(){
    return $this->belongsTo('App\Lan');
  }
}
