<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function aw()
    {
        return $this->belongsTo('App\Aw');
    }

    public function workers()
    {
        return $this->belongsToMany('App\Worker','task_worker');
    }

    public function getstartDatetimeAttribute()
    {
        // class = ['lunch','health','sport']
        return substr($this->date . " " . $this->start, 0, -3);

    }

    public function getfinishDatetimeAttribute()
    {
        return substr($this->date . " " . $this->finish, 0, -3);
    }
}
