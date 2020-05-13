<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

	protected $fillable = ['name_material', 'desc_material'];

	public $timestamps=false;

	public function lans()
	{
	return $this->belongsToMany('App\Lan','needs');
	}

	public function shoppings()
	{
	return $this->hasMany('App\Shopping');
	}
}
