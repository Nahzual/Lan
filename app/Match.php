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

  public function teams()
  {
    return $this->belongsToMany('App\Team','oppose');
  }

  public function round(){
    return $this->belongsTo('App\Round');
  }
}
