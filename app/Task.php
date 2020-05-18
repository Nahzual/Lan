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

	public $timestamps=false;

	/*Returns the parent LAN of this task*/
	public function lan(){
		return $this->belongsTo('App\Lan');
	}

	/*Returns the users assigned to this task*/
	public function users(){
		return $this->belongsToMany('App\User','assigned_to');
	}
}
