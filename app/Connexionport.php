<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connexionport extends Model
{
	  /**
	   * The attributes that are mass assignable.
	   *
	   * @var array
	   */
	protected $fillable = ['port_connexionport'];

	/*Returns all the parent games*/
  	public function games(){
   		 $this->belongsToMany('App\Game','uses_port');
  	}

	/*Returns all the LANs using this connexion_port*/
  	public function lans(){
    		$this->belongsToMany('App\Lan','uses_port');
  	}	
}
