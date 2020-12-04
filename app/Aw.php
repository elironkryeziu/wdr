<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aw extends Model
{
    //
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function items()
    {
        return $this->hasMany('App\AwItem');
    }
}
