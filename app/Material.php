<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

	protected $fillable = ['name_material', 'desc_material'];

	public $timestamps=false;

	/*Returns the LANs using this material*/
	public function lans(){
		return $this->belongsToMany('App\Lan','needs');
	}

	/*Returns the shopping list with this material in*/
	public function shoppings(){
		return $this->hasMany('App\Shopping');
	}
}
