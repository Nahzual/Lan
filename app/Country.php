<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	public $timestamps = false;
	
	protected $fillable = ['name_country'];
	
	/*Return all the cild departments*/
	public function departments()
	{
		return $this->hasMany('App\Department');
	}
}
