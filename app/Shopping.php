<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	public $timestamps = false;

	protected $fillable = ['cost_shopping', 'quantity_shopping'];

	public function lans()
	{
	return $this->belongsToMany('App\Lan','requires');
	}

	public function materials()
	{
		return $this->belongsToMany('App\Material','contains');
	}
}
