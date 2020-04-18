<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name_game', 'desc_game', 'release_date_game', 'cost_game', 'is_multiplayer_game'];

  public function ports(){
    $this->belongsToMany('App\Connexionport','uses_port');
  }

  public function lans()
  {
    return $this->belongsToMany('App\Lan','can_play');
  }

  public function users()
  {
    return $this->belongsToMany('App\User','favorite_games');
  }

  public function tournaments()
  {
    return $this->belongsTo('App\Tournament');
  }


}
