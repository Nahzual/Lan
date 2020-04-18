<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id_round'];

  public function users()
  {
    return $this->belongsToMany('App\User','oppose');
  }

  public function round(){
    return $this->hasOne('App\Round');
  }
}
