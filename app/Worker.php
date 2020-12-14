<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    //
    protected $guarded = [];

    public function pauses()
    {
        return $this->hasMany('App\Pause');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task','task_worker');
    }

    public function getinitialsAttribute()
    {
        return substr($this->first_name, 0, 1).substr($this->last_name, 0, 1);
    }

    public function getfullNameAttribute()
    {
        return $this->first_name. ' '.$this->last_name;
    }
}
