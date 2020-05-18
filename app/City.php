<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public $timestamps = false;
	
    	protected $fillable = ['name_city', 'zip_city'];
	
	/*Returns the child streets for this city*/
	public function streets()
	{
		return $this->hasMany('App\Street');
	}
	
	/*Returns the parent department for this city*/
	public function department()
	{
		return $this->belongsTo('App\Department');
	}
}
