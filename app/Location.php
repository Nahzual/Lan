<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	public $timestamps = false;
	
    	protected $fillable = ['num_location'];
	
	/*Returns the location's street*/
	public function street(){
		return $this->belongsTo('App\Street');
	}
	
	/*Returns all the LANS happening here*/
	public function lans(){
		return $this->hasMany('App\Lan');
	}
}
