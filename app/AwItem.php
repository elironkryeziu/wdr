<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwItem extends Model
{
    //
    protected $guarded = [];

    public function aw()
    {
        return $this->belongsTo('App\Aw');
    }
}
