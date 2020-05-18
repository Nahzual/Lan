<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
	public $timestamps = false;
	
    	protected $fillable = ['name_street'];
	
	/*Returns all the locations within this street*/
	public function locations(){
		return $this->hasMany('App\Location');
	}
	
	/*Returns the parent city of this street*/
	public function city(){
		return $this->belongsTo('App\City');
	}
}
