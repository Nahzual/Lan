<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name_task','desc_task','deadline_task','id_lan'];

  public function lan(){
    return $this->belongsTo('App\Lan');
  }
}
