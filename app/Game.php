<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	  /**
	   * The attributes that are mass assignable.
	   *
	   * @var array
	   */
	protected $fillable = ['name_game', 'desc_game', 'release_date_game', 'cost_game', 'is_multiplayer_game'];

  	public $timestamps=false;

	/*Returns the connexion_ports used for this game*/
 	public function ports($lanId=null){
   	if(isset($lanId)) return $this->belongsToMany('App\Lan','uses_port','id_game','id_lan')->where('id_lan','=',$lanId)->select('uses_port.port');
		else return $this->belongsToMany('App\Lan','uses_port','id_game','id_lan')->select('uses_port.port');
	}

	/*Returns the connexion_ports used for this game as String*/
	public function ports_string($ports_collection=null,$lanId){
		if(!isset($ports_collection)) $ports_collection=$this->ports($lanId)->get();
		$list='';
		$size=count($ports_collection);
		$toEnd=$size;
		foreach($ports_collection as $port){
			--$toEnd;
			if($toEnd==0){
				$list.=$port->port;
			}else if($toEnd==$size){
				$list.=' '.$port->port.' , ';
			}else{
				$list.=$port->port.' , ';
			}
		}
		return $list;
	}

	/*Returns the LANs listing this game*/
 	public function lans(){
		return $this->belongsToMany('App\Lan','can_play');
	}

	/*Returns all the beloved users*/
	public function users(){
    		return $this->belongsToMany('App\User','favorite_games');
	}

	/*Returns all the tournaments with this game listed*/
	public function tournaments(){
		return $this->belongsToMany('App\Tournament');
	}
}
