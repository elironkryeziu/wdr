<?php

namespace App;

use Illuminate\Support\Facades\DB;
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

    public function getisClosedAttribute()
    {
        if(DB::table('tasks')->where('aw_id', $this->id)->where('closed',0)->exists())
        {
            return false;
        } else 
        {
            return true;
        }
    }
}
