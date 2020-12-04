<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pause extends Model
{
    //
    protected $guarded = [];
    
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
