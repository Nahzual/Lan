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

	public function lan()
	{
	return $this->belongsTo('App\Lan');
	}

	public function material()
	{
		return $this->belongsTo('App\Material');
	}
}
