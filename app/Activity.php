<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_activity', 'desc_activity', 'id_lan'];

    public function lan(){
      return $this->hasOne('App\Lan');
    }
}
