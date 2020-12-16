<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsualTask extends Model
{
    //
    protected $guarded = [];

    public function workers()
    {
        return $this->belongsToMany('App\Worker','usualtask_worker');
    }

    public function getisDailyAttribute()
    {
        //
        if (!$this->monthly)
        {
            if (!$this->monday)
            {
                $daily = false;
            } else if (!$this->tuesday)
            {
                $daily = false;
            } else if (!$this->wednesday)
            {
                $daily = false;
            } else if (!$this->thursday)
            {
                $daily = false;
            } else if (!$this->friday)
            {
                $daily = false;
            } else
            {
                $daily = true;
            }
            return $daily;
        } 
        return null;
    }

    public function gettypeAttribute()
    {
        if ($this->monthly)
        {
            return 'monthly';
        } else if ($this->isDaily)
        {
            return 'daily';
        } else
        {
            return 'weekly';
        }
    }

    public function getdaysAttribute()
    {
        //
        $days = Array();
        if ($this->monday)
            {
                $day['id'] = 0;
                $day['name'] = "Monday";
                array_push($days,$day);
            }
        if ($this->tuesday)
            {
                $day['id'] = 1;
                $day['name'] = "Tuesday";
                array_push($days,$day);
            }
        if ($this->wednesday)
            {
                $day['id'] = 2;
                $day['name'] = "Wednesday";
                array_push($days,$day);
            }
        if ($this->thursday)
            {
                $day['id'] = 3;
                $day['name'] = "Thursday";
                array_push($days,$day);
            }
        if ($this->friday)
            {
                $day['id'] = 4;
                $day['name'] = "Friday";
                array_push($days,$day);
            }

        return $days;
    }

    public function getstatusAttribute()
    {
        $referent_task = Task::where('usual_task_id',$this->id)->orderBy('id','desc')->first();

        return $referent_task->status;
    }

    public function scopeMonthly($query)
    {
        return $query->where('monthly', true);
    }

    public function scopeWeekly($query)
    {
        return $query->where(function ($query) {
                $query->where('monday', false)
                    ->orWhere('tuesday', false)
                    ->orWhere('wednesday', false)
                    ->orWhere('thursday', false)
                    ->orWhere('friday', false);
            })->where(function ($query) {
                $query->where('monthly', false);
            });
    }

    public function scopeDaily($query)
    {
        $days = [
            'monday' => true,
            'tuesday' => true,
            'wednesday' => true,
            'thursday' => true,
            'friday' => true,
        ];

        return $query->where($days);
    }

    public function scopeDay($query,$day)
    {
        return $query->where(strtolower($day),true);
    }

}
