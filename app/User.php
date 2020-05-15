<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
		use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'pseudo', 'email', 'tel_user', 'password', 'theme'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public function lans()
	{
		return $this->belongsToMany('App\Lan');
	}

	public function tasks()
	{
		return $this->belongsToMany('App\Task','assigned_to');
	}

  public function games()
  {
    return $this->belongsToMany('App\Game','favorite_games');
  }

  public function teams()
  {
    return $this->belongsToMany('App\Team','part_of');
  }

  public function location(){
    return $this->belongsTo('App\Location');
  }

	public function isSiteAdmin(){
		return $this->rank_user==config('ranks.SITE_ADMIN');
	}


}
