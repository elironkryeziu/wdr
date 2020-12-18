<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Worker as WorkerResource;

class WeeklyTask extends JsonResource
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
            'type' => 'weekly',
            'id' => $this->id,
            'name' => $this->name,
            'notes' => $this->notes,
            'days' => $this->days,
            'status' => $this->status,
            'start' => $this->start,
            'finish' => $this->finish,
            'workers' => WorkerResource::collection($this->workers)
        ];
    }
}
