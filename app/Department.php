<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	public $timestamps = false;
	
    	protected $fillable = ['name_department'];
	
	/*Returns all the child cities*/
	public function cities()
	{
		return $this->hasMany('App\City');
	}
	
	/*Returns the parent country*/
	public function country()
	{
		return $this->belongsTo('App\Country');
	}
}
