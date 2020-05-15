<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['max_player_count', 'match_duration', 'max_player_count_per_match', 'id_tournament'];

  public function matches()
  {
    return $this->hasMany('App\Match');
  }

  public function tournament(){
    return $this->belongsTo('App\Tournament');
  }
}
