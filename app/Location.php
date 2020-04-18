<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['num_location'];
	
	public function street()
	{
		return $this->belongsTo('App\Street');
	}
	
	public function lans()
	{
		return $this->hasMany('App\Lan');
	}
}
