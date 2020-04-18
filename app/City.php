<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['name_city', 'zip_city'];
	
	public function streets()
	{
		return $this->hasMany('App\Street');
	}
	
	public function department()
	{
		return $this->belongsTo('App\Department');
	}
}
