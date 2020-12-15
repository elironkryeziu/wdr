<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyTask extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'monthly',
            'id' => $this->id,
            'name' => $this->name,
            'day_of_month' => $this->month_day,
            // 'status' => $this->status, -ma vone
            // 'workers' => WorkerResource::collection($this->workers) -me ndreq relationship
        ];
    }
}
