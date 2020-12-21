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

    public function usualtasks()
    {
        return $this->belongsToMany('App\UsualTask','usualtask_worker');
    }

    public function getinitialsAttribute()
    {
        return substr(iconv('utf-8', 'ascii//TRANSLIT', mb_convert_encoding($this->first_name, 'UTF-8', 'UTF-8')),0,1)
        .substr(iconv('utf-8', 'ascii//TRANSLIT', mb_convert_encoding($this->last_name, 'UTF-8', 'UTF-8')),0,1);
    }

    public function getfullNameAttribute()
    {
        return mb_convert_encoding($this->first_name, 'UTF-8', 'UTF-8').' '.mb_convert_encoding($this->last_name, 'UTF-8', 'UTF-8');
    }
}
