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

  public function ports(){
    return $this->belongsToMany('App\Lan','uses_port','id_game','id_lan')->select('uses_port.port');
  }

	public function ports_string($ports_collection=null){
		if(!isset($ports_collection)) $ports_collection=$this->ports;
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

  public function lans()
  {
    return $this->belongsToMany('App\Lan','can_play');
  }

  public function users()
  {
    return $this->belongsToMany('App\User','favorite_games');
  }

  public function tournaments()
  {
    return $this->belongsToMany('App\Tournament');
  }


}
