<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['name_department'];
	
	public function cities()
	{
		return $this->hasMany('App\City');
	}
	
	public function country()
	{
		return $this->belongsTo('App\Country');
	}
}
