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
}
