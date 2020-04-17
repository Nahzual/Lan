<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lan extends Model
{
    protected $fillable = ['name','max_num_registrants','opening_date','duration','budget','waiting_lan'];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
