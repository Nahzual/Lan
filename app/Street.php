<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['name_street'];
	
	public function locations()
	{
		return $this->hasMany('App\Location');
	}
	
	public function city()
	{
		return $this->belongsTo('App\City');
	}
}
