<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	public $timestamps = false;
	
	protected $fillable = ['name_country'];
	
	public function departments()
	{
		return $this->hasMany('App\Department');
	}
}
