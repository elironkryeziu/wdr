<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Worker as WorkerResource;


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
            'notes' => $this->notes,
            'day_of_month' => $this->month_day,
            'status' => $this->status,
            'start' => $this->start,
            'finish' => $this->finish,
            'workers' => WorkerResource::collection($this->workers)
        ];
    }
}
