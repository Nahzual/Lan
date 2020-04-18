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
  protected $fillable = ['name_tournament','desc_tournament','opening_date_tournament', 'is_finished_tournament', 'player_count', 'match_mod', 'max_player_count', 'id_game', 'id_lan'];

  public function rounds()
  {
    return $this->belongsTo('App\Round');
  }

  public function game(){
    return $this->hasOne('App\Game');
  }

  public function lan(){
    return $this->hasOne('App\Lan');
  }
}
